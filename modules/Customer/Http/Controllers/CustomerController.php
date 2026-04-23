<?php

namespace Modules\Customer\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Customer\Actions\CustomerDeleteAction;
use Modules\Customer\Actions\CustomerListAction;
use Modules\Customer\Actions\CustomerStoreAction;
use Modules\Customer\Actions\CustomerUpdateAction;
use Modules\Customer\Actions\MasterCustomerAction;
use Modules\Customer\Actions\TruncateCustomerAction;
use Modules\Customer\DataTransferObjects\CustomerData;
use Modules\Customer\Http\Requests\CustomerRequest;
use Modules\Customer\Http\Resources\CustomerResource;
use Modules\Customer\Models\Customer;

class CustomerController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly CustomerListAction $listAction,
        private readonly CustomerStoreAction $storeAction,
        private readonly CustomerUpdateAction $updateAction,
        private readonly CustomerDeleteAction $deleteAction,
        private readonly MasterCustomerAction $masterCustomerAction,
        private readonly TruncateCustomerAction $truncateCustomerAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $customers = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(CustomerResource::collection($customers), 'Customers retrieved successfully');
    }

    public function store(CustomerRequest $request): JsonResponse
    {
        $data = CustomerData::fromRequest($request);
        $customer = $this->storeAction->execute($data);
        return $this->success(new CustomerResource($customer), 'Customer created successfully', 201);
    }

    public function show(Customer $customer): JsonResponse
    {
        return $this->success(new CustomerResource($customer), 'Customer details retrieved');
    }

    public function update(CustomerRequest $request, Customer $customer): JsonResponse
    {
        $data = CustomerData::fromRequest($request);
        $updatedCustomer = $this->updateAction->execute($customer, $data);
        return $this->success(new CustomerResource($updatedCustomer), 'Customer updated successfully');
    }

    public function destroy(Customer $customer): JsonResponse
    {
        $this->deleteAction->execute($customer);
        return $this->success(null, 'Customer deleted successfully');
    }

    /**
     * Carga masiva de datos maestros de cliente.
     * Recibe el JSON de Polar en formato:
     * [{ "name": "CUSTOMERS", "value": { "type1": [...], "type2": [...], ... } }]
     *
     * Procesa las 9 secciones en orden de dependencias dentro de UNA transacción e implementa upserts en bloque.
     *
     * @OA\Post(
     *     path="/api/mastercustomer",
     *     summary="Carga masiva de datos maestros de cliente",
     *     description="Procesa un array de datos anidados para clientes e inserta o actualiza registros usando Upsert por lotes. Soporta el formato JSON de envoltura de Polar.",
     *     tags={"Cargas Masivas - MasterCustomer"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="name", type="string", example="CUSTOMERS"),
     *                 @OA\Property(
     *                     property="value",
     *                     type="object",
     *                     @OA\Property(property="type1", type="array", @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="tp1Code", type="string", example="111"),
     *                         @OA\Property(property="tp1Name", type="string", example="CS Alta Visibilidad")
     *                     )),
     *                     @OA\Property(property="type2", type="array", @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="tp2Code", type="string", example="TC001"),
     *                         @OA\Property(property="tp2Name", type="string", example="BODEGA")
     *                     )),
     *                     @OA\Property(property="city", type="array", @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="citCode", type="string", example="15"),
     *                         @OA\Property(property="citName", type="string", example="Miranda"),
     *                         @OA\Property(property="staCode", type="string", example="MIR")
     *                     )),
     *                     @OA\Property(property="frequency", type="array", @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="freCode", type="string", example="01"),
     *                         @OA\Property(property="freName", type="string", example="Semanal"),
     *                         @OA\Property(property="freWeek1", type="string", example="1"),
     *                         @OA\Property(property="freWeek2", type="string", example="1"),
     *                         @OA\Property(property="freWeek3", type="string", example="1"),
     *                         @OA\Property(property="freWeek4", type="string", example="1"),
     *                         @OA\Property(property="freCustomer", type="string", example="1")
     *                     )),
     *                     @OA\Property(property="infoType", type="array", @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="iftCode", type="string", example="04"),
     *                         @OA\Property(property="iftName", type="string", example="Den. Comercial"),
     *                         @OA\Property(property="iftCharType", type="string", example="04")
     *                     )),
     *                     @OA\Property(property="customer", type="array", @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="cusCode", type="string", example="0001"),
     *                         @OA\Property(property="cusName", type="string", example="CLIENTE EJEMPLO"),
     *                         @OA\Property(property="tp1Code", type="string", example="111"),
     *                         @OA\Property(property="tp2Code", type="string", example="TC001"),
     *                         @OA\Property(property="citCode", type="string", example="15")
     *                     )),
     *                     @OA\Property(property="customerRoute", type="array", @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="rotCode", type="string", example="R01"),
     *                         @OA\Property(property="cusCode", type="string", example="0001"),
     *                         @OA\Property(property="freCode", type="string", example="01")
     *                     )),
     *                     @OA\Property(property="customerPrice", type="array", @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="rotCode", type="string", example="R01"),
     *                         @OA\Property(property="cusCode", type="string", example="0001"),
     *                         @OA\Property(property="prcCode", type="string", example="PR01")
     *                     )),
     *                     @OA\Property(property="customerInfo", type="array", @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="cusCode", type="string", example="0001"),
     *                         @OA\Property(property="iftCode", type="string", example="04"),
     *                         @OA\Property(property="ctnCharValue", type="string", example="VALOR_123")
     *                     ))
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Carga procesada exitosamente con resumen estadístico.",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Master Customer: 7854 procesado(s), 14 omitido(s), 0 duplicado(s) eliminado(s)"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="summary", type="object",
     *                     @OA\Property(property="total_processed", type="integer", example=7854),
     *                     @OA\Property(property="total_skipped", type="integer", example=14),
     *                     @OA\Property(property="total_duplicates", type="integer", example=0)
     *                 ),
     *                 @OA\Property(property="detail", type="object")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=422, description="Error de formato o codificación"),
     *     @OA\Response(response=500, description="Error interno")
     * )
     */
    public function masterCustomer(Request $request): JsonResponse
    {
        try {
            // Validación de encoding: normalizar ISO-8859-1 a UTF-8 si es necesario
            $rawContent = $request->getContent();
            
            $encoding = mb_detect_encoding($rawContent, ['UTF-8', 'ISO-8859-1', 'Windows-1252'], true);
            
            if ($encoding !== 'UTF-8') {
                $rawContent = mb_convert_encoding($rawContent, 'UTF-8', $encoding ?: 'ISO-8859-1');
            }

            // Limpieza de caracteres de reemplazo si ya vienen rotos
            $rawContent = str_replace("\xEF\xBF\xBD", "O", $rawContent);

            $payload = json_decode($rawContent, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->error('Error de encoding en el payload: ' . json_last_error_msg(), 422);
            }

            // Si el payload es un array indexado con wrapper de Polar, pasarlo directo
            // Si viene sin wrapper (acceso directo al "value"), envolverlo
            if (isset($payload[0]['name']) && isset($payload[0]['value'])) {
                // Formato Polar: [{ "name": "CUSTOMERS", "value": {...} }]
                $items = $payload;
            } elseif (isset($payload['customer']) || isset($payload['type1']) || isset($payload['type2'])) {
                // Formato directo sin wrapper: { "customer": [...], "type1": [...], ... }
                $items = [['name' => 'CUSTOMERS', 'value' => $payload]];
            } else {
                return $this->error('Formato de payload no reconocido. Se esperaba el formato Polar CUSTOMERS.', 422);
            }

            $results = $this->masterCustomerAction->execute($items);

            // Calcular totales globales
            $totalProcessed = 0;
            $totalSkipped = 0;
            $totalDuplicates = 0;
            foreach ($results as $section => $stats) {
                $totalProcessed += $stats['processed'] ?? 0;
                $totalSkipped += $stats['skipped'] ?? 0;
                $totalDuplicates += $stats['duplicates_removed'] ?? 0;
            }

            $responseData = [
                'summary' => [
                    'total_processed'    => $totalProcessed,
                    'total_skipped'      => $totalSkipped,
                    'total_duplicates'   => $totalDuplicates,
                ],
                'detail' => $results,
            ];

            return $this->success(
                $responseData,
                "Master Customer: {$totalProcessed} procesado(s), {$totalSkipped} omitido(s), {$totalDuplicates} duplicado(s) eliminado(s)",
                201
            );
        } catch (\Exception $e) {
            return $this->error('Error al procesar la carga masiva: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Truncar todas las tablas de datos maestros de cliente.
     *
     * Vacía las 9 tablas en estricto orden inverso de dependencias:
     * customer_prices → customer_infos → customer_routes → customers → customer_info_types → 
     * customer_frequencies → customer_cities → customer_branches → customer_groups.
     *
     * @OA\Delete(
     *     path="/api/truncate-customers",
     *     summary="Truncar tablas de clientes",
     *     description="Vacía todas las tablas relacionadas con datos maestros de cliente respetando el orden de dependencias.",
     *     tags={"Cargas Masivas - MasterCustomer"},
     *     @OA\Response(
     *         response=200,
     *         description="Tablas truncadas exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Truncate completado: 12500 registro(s) eliminado(s)"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="customer_prices", type="integer", example=4500),
     *                 @OA\Property(property="customer_infos", type="integer", example=4500),
     *                 @OA\Property(property="customer_routes", type="integer", example=4500),
     *                 @OA\Property(property="customers", type="integer", example=2000),
     *                 @OA\Property(property="customer_info_types", type="integer", example=1000),
     *                 @OA\Property(property="customer_frequencies", type="integer", example=2000),
     *                 @OA\Property(property="customer_cities", type="integer", example=500),
     *                 @OA\Property(property="customer_branches", type="integer", example=500),
     *                 @OA\Property(property="customer_groups", type="integer", example=2000)
     *             )
     *         )
     *     ),
     *     @OA\Response(response=500, description="Error interno")
     * )
     */
    public function truncateCustomers(): JsonResponse
    {
        try {
            $counts = $this->truncateCustomerAction->execute();
            $totalDeleted = array_sum($counts);
            return $this->success($counts, "Truncate completado: {$totalDeleted} registro(s) eliminado(s)");
        } catch (\Exception $e) {
            return $this->error('Error al truncar tablas: ' . $e->getMessage(), 500);
        }
    }
}
