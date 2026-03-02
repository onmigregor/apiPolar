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
        private readonly MasterCustomerAction $masterCustomerAction
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
     * Recibe un JSON con un ARRAY de bloques, cada uno con secciones:
     * Clientes, GrupoCliente, ramoCliente, regionCliente, frecuenciaTb,
     * frecuenciaCliente, licenciaTb.
     * Soporta 1 a N clientes en una sola transacción.
     */
    public function masterCustomer(Request $request): JsonResponse
    {
        try {
            $items = $request->all();

            // Si envían un solo objeto (no array), lo envolvemos en array
            if (isset($items['Clientes']) || isset($items['GrupoCliente'])) {
                $items = [$items];
            }

            $results = $this->masterCustomerAction->execute($items);
            return $this->success($results, 'Master Customer: ' . count($results) . ' registro(s) creado(s) exitosamente', 201);
        } catch (\Exception $e) {
            return $this->error('Error al procesar la carga masiva: ' . $e->getMessage(), 500);
        }
    }
}
