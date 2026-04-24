<?php

namespace Modules\DynamicPlan\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\DynamicPlan\Models\PlanesDinamicosPolar;

class SyncDynamicPlansToTenantsAction
{
    public function execute(): array
    {
        Log::info("=== ADMIN: INICIO SYNC A TENANTS ===");

        // 1. Obtener datos
        $plans = PlanesDinamicosPolar::all()->toArray();
        Log::info("ADMIN: Registros locales a enviar: " . count($plans));

        if (empty($plans)) {
            Log::warning("ADMIN: No hay planes para enviar.");
            return ['success' => false, 'message' => 'No hay registros.'];
        }

        // 2. Enviar a PolarAPI
        try {
            $baseUrl = env('POLAR_API_URL', 'http://polar_api/api');
            $apiUrl = $baseUrl . '/dynamic-plans/sync-polar';
            $apiToken = env('POLAR_API_TOKEN');

            Log::info("ADMIN: Llamando a API: " . $apiUrl);

            $response = Http::withToken($apiToken)
                ->timeout(120)
                ->post($apiUrl, ['data' => $plans]);

            if ($response->successful()) {
                Log::info("ADMIN: Respuesta API exitosa: " . json_encode($response->json()['data'] ?? []));
                return [
                    'success' => true, 
                    'message' => 'Sincronización completada correctamente.',
                    'data' => $response->json()['data'] ?? []
                ];
            }

            Log::error("ADMIN: Error API Status: " . $response->status() . " Body: " . $response->body());
            return ['success' => false, 'message' => 'Error API: ' . ($response->json()['message'] ?? 'Desconocido')];

        } catch (\Exception $e) {
            Log::error("ADMIN: Excepción: " . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
