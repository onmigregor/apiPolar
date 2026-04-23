<?php

namespace Modules\Customer\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExportCustomersToPolarApiAction
{
    public function execute(): array
    {
        // 1. Obtener clientes con su ruta asignada
        // Hacemos un join con customer_routes para obtener el rot_code
        $customers = DB::table('customers')
            ->leftJoin('customer_routes', function($join) {
                $join->on(DB::raw("TRIM(LEADING '0' FROM customers.cus_code)"), '=', DB::raw("TRIM(LEADING '0' FROM customer_routes.cus_code)"));
            })
            ->select(
                'customers.cus_code',
                'customers.cus_name',
                'customers.cus_business_name',
                'customers.cus_administrator',
                'customers.cus_tax_id1',
                'customers.cus_street1',
                'customers.cus_street2',
                'customers.cus_street3',
                'customers.cus_latitude',
                'customers.cus_longitude',
                'customers.cus_contact_person',
                'customers.cus_phone',
                'customer_routes.rot_code',
                'customer_routes.ctr_monday',
                'customer_routes.ctr_tuesday',
                'customer_routes.ctr_wednesday',
                'customer_routes.ctr_thursday',
                'customer_routes.ctr_friday',
                'customer_routes.ctr_saturday',
                'customer_routes.ctr_sunday'
            )
            ->get();

        $payload = [];
        foreach ($customers as $customer) {
            // Normalizar el rot_code: Prepend "V" si no la tiene
            $routeCode = $customer->rot_code;
            if ($routeCode && !str_starts_with($routeCode, 'V')) {
                $routeCode = 'V' . $routeCode;
            }

            $payload[] = [
                'cus_code' => $customer->cus_code,
                'cus_name' => $customer->cus_name,
                'cus_business_name' => $customer->cus_business_name,
                'cus_administrator' => $customer->cus_administrator,
                'cus_tax_id1' => $customer->cus_tax_id1,
                'address' => trim($customer->cus_street1 . ' ' . $customer->cus_street2 . ' ' . $customer->cus_street3),
                'latitude' => $customer->cus_latitude,
                'longitude' => $customer->cus_longitude,
                'contact_person' => $customer->cus_contact_person,
                'phone' => $customer->cus_phone,
                'route_name' => $routeCode, // Ej: V09011
            ];
        }

        if (empty($payload)) {
            Log::warning("ExportCustomersToPolarApiAction: No customers found to sync.");
            return ['success' => false, 'message' => 'No hay clientes para sincronizar'];
        }

        Log::info("ExportCustomersToPolarApiAction: Sending " . count($payload) . " customers to PolarAPI.");

        // 2. Enviar a PolarAPI
        try {
            $baseUrl = env('POLAR_API_URL', 'http://polar_api/api');
            $apiUrl = $baseUrl . '/master-clients/sync-polar';
            $apiToken = env('POLAR_API_TOKEN');

            Log::info("ExportCustomersToPolarApiAction: Attempting sync to " . $apiUrl);

            $response = Http::withToken($apiToken)
                ->timeout(60) // Clientes pueden ser muchos, damos más tiempo
                ->post($apiUrl, ['data' => $payload]);

            if ($response->successful()) {
                Log::info("ExportCustomersToPolarApiAction: Sync successful.");
                return [
                    'success' => true, 
                    'message' => 'Sincronización completada',
                    'data' => $response->json()
                ];
            }

            Log::error("ExportCustomersToPolarApiAction: Sync failed. Status: " . $response->status() . " Response: " . $response->body());
            return [
                'success' => false, 
                'message' => 'Error en la API de Polar: ' . ($response->json()['message'] ?? 'Error desconocido')
            ];

        } catch (\Exception $e) {
            Log::error("ExportCustomersToPolarApiAction: Exception: " . $e->getMessage());
            return [
                'success' => false, 
                'message' => 'Error de conexión: ' . $e->getMessage()
            ];
        }
    }
}
