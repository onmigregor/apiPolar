<?php

namespace Modules\Company\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExportTenantsToPolarApiAction
{
    public function execute(): array
    {
        // 1. Obtener los Logins de la base de datos local (productosPolarApi)
        $logins = DB::table('companies_logins')->get();
        $payload = [];

        foreach ($logins as $login) {
            // Lógica de matching con Territories (ya validada)
            $normalizedLgnCode = ltrim($login->lgn_code, '0');
            
            $territory = DB::table('companies_territories')
                ->where('lgn_code', $normalizedLgnCode)
                ->orWhere('lgn_code', $normalizedLgnCode . '00')
                ->first();

            if (!$territory) {
                // Si no hay match directo, buscar por nombre si hay duplicados
                $territories = DB::table('companies_territories')
                    ->where('lgn_code', 'like', "%$normalizedLgnCode%")
                    ->get();
                
                foreach ($territories as $t) {
                    $parts = explode('-', $t->try_code);
                    $tenantCandidate = $parts[1] ?? ($parts[0] ?? '');
                    if ($tenantCandidate && str_contains($t->try_name, "Ruta " . $tenantCandidate)) {
                        $territory = $t;
                        break;
                    }
                }
            }

            if ($territory) {
                Log::info("Match found for Login {$login->lgn_code}: Territory {$territory->try_code}");
                $parts = explode('-', $territory->try_code);
                $tenant = $parts[1] ?? ($parts[0] ?? 'UNKNOWN');

                $payload[] = [
                    'code' => $login->brc_code . '_' . $tenant, // Concatenado para unicidad
                    'name' => $login->lgn_name, // Nombre Empresa
                    'route_name' => strtolower($tenant),    // Ej: v56161 (en minúsculas)
                    'cep' => $normalizedLgnCode, // Código sin ceros
                    'db_name' => 'www_' . strtolower($tenant) . 'p', // Prefijo y sufijo solicitado en minúsculas
                ];
            }
        }

        if (empty($payload)) {
            Log::warning("ExportTenantsToPolarApiAction: No data found to sync.");
            return ['success' => false, 'message' => 'No data found to sync'];
        }

        Log::info("ExportTenantsToPolarApiAction: Sending payload with " . count($payload) . " records.");
        
        // 2. Enviar a PolarAPI
        try {
            $baseUrl = env('POLAR_API_URL', 'http://polar_api/api');
            $apiUrl = $baseUrl . '/company-routes/sync';
            $apiToken = env('POLAR_API_TOKEN');

            Log::info("ExportTenantsToPolarApiAction: Attempting sync to " . $apiUrl);

            $response = Http::withToken($apiToken)
                ->timeout(30)
                ->post($apiUrl, ['data' => $payload]);

            if ($response->successful()) {
                return [
                    'success' => true, 
                    'message' => 'Synchronization successful', 
                    'results' => $response->json()['data'] ?? []
                ];
            }

            return [
                'success' => false, 
                'message' => 'API Error: ' . ($response->json()['message'] ?? $response->status())
            ];

        } catch (\Exception $e) {
            Log::error('ExportTenantsToPolarApiAction: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Exception: ' . $e->getMessage()];
        }
    }
}
