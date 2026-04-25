<?php

namespace Modules\ProductsPrice\Actions;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\ProductsPrice\Models\ProductsPrice;

class SyncProductsPriceToPolarApiAction
{
    public function execute()
    {
        Log::info("Iniciando sincronización de Precios por Franquicia desde Admin hacia PolarAPI");

        $data = ProductsPrice::all()->toArray();

        if (empty($data)) {
            return [
                'success' => false,
                'message' => 'No hay datos para sincronizar.'
            ];
        }

        $apiUrl = env('POLAR_API_URL', 'http://polar_api/api');
        $apiToken = env('POLAR_API_TOKEN');

        try {
            $response = Http::withToken($apiToken)
                ->timeout(120)
                ->post("{$apiUrl}/master-products-price/sync", ['data' => $data]);

            if ($response->successful()) {
                Log::info("Sincronización de Precios por Franquicia exitosa.");
                return [
                    'success' => true,
                    'message' => 'Sincronización completada correctamente.',
                    'data'    => $response->json()['data'] ?? []
                ];
            }

            Log::error("Error en la respuesta de PolarAPI: " . $response->body());
            return [
                'success' => false,
                'message' => 'Error en el servidor API: ' . ($response->json('message') ?? $response->status())
            ];

        } catch (\Exception $e) {
            Log::error("Fallo la conexión con PolarAPI: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'No se pudo conectar con la API: ' . $e->getMessage()
            ];
        }
    }
}
