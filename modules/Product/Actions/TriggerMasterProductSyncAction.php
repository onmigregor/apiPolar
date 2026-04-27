<?php

namespace Modules\Product\Actions;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TriggerMasterProductSyncAction
{
    public function execute(): array
    {
        try {
            $baseUrl = env('POLAR_API_URL', 'http://polar_api/api');
            $apiUrl = $baseUrl . '/master-products/sync';
            $apiToken = env('POLAR_API_TOKEN');

            Log::info("TriggerMasterProductSyncAction: Requesting Hub to pull products from Admin. URL: " . $apiUrl);

            $response = Http::withToken($apiToken)
                ->timeout(120) // Aumentamos el timeout porque la carga de productos es pesada
                ->post($apiUrl);

            if ($response->successful()) {
                Log::info("TriggerMasterProductSyncAction: Hub confirmed sync completion.");
                return [
                    'success' => true,
                    'message' => 'Sincronización completada exitosamente en el Hub.',
                    'data' => $response->json()
                ];
            }

            Log::error("TriggerMasterProductSyncAction: Hub failed to sync. Status: " . $response->status() . " Body: " . $response->body());
            return [
                'success' => false,
                'message' => 'El Hub reportó un error: ' . ($response->json()['message'] ?? 'Error desconocido')
            ];

        } catch (\Exception $e) {
            Log::error("TriggerMasterProductSyncAction: Exception: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Error de conexión con el Hub: ' . $e->getMessage()
            ];
        }
    }
}
