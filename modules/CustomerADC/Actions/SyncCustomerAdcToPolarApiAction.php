<?php

namespace Modules\CustomerADC\Actions;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\CustomerADC\Models\CustomerAdc;

class SyncCustomerAdcToPolarApiAction
{
    public function execute()
    {
        Log::info("Iniciando sincronización de Equipos ADC desde Admin hacia PolarAPI");

        $data = CustomerAdc::all()->map(function ($item) {
            return [
                'fq_redi'     => $item->fq_redi,
                'cus_code'    => $item->id_customer,
                'marca'       => $item->marca,
                'no_serie'    => $item->no_serie,
                'no_serial'   => $item->no_serial,
                'no_activo'   => $item->no_activo,
                'empresa'     => $item->empresa,
                'estado'      => $item->estado,
                'tipo_activo' => $item->tipo_activo,
            ];
        })->toArray();

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
                ->post("{$apiUrl}/master-customer-adc/sync", ['data' => $data]);

            if ($response->successful()) {
                Log::info("Sincronización de Equipos ADC exitosa.");
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
