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
        private readonly CustomerDeleteAction $deleteAction
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
}
