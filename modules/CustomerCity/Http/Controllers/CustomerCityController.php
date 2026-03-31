<?php

namespace Modules\CustomerCity\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\CustomerCity\Actions\CustomerCityDeleteAction;
use Modules\CustomerCity\Actions\CustomerCityListAction;
use Modules\CustomerCity\Actions\CustomerCityStoreAction;
use Modules\CustomerCity\Actions\CustomerCityUpdateAction;
use Modules\CustomerCity\DataTransferObjects\CustomerCityData;
use Modules\CustomerCity\Http\Requests\CustomerCityRequest;
use Modules\CustomerCity\Http\Resources\CustomerCityResource;
use Modules\CustomerCity\Models\CustomerCity;

class CustomerCityController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly CustomerCityListAction $listAction,
        private readonly CustomerCityStoreAction $storeAction,
        private readonly CustomerCityUpdateAction $updateAction,
        private readonly CustomerCityDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $customer_cities = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(CustomerCityResource::collection($customer_cities), 'CustomerCities retrieved successfully');
    }

    public function store(CustomerCityRequest $request): JsonResponse
    {
        $data = CustomerCityData::fromRequest($request);
        $customer_city = $this->storeAction->execute($data);
        return $this->success(new CustomerCityResource($customer_city), 'CustomerCity created successfully', 201);
    }

    public function show(CustomerCity $customer_city): JsonResponse
    {
        return $this->success(new CustomerCityResource($customer_city), 'CustomerCity details retrieved');
    }

    public function update(CustomerCityRequest $request, CustomerCity $customer_city): JsonResponse
    {
        $data = CustomerCityData::fromRequest($request);
        $updatedCustomerCity = $this->updateAction->execute($customer_city, $data);
        return $this->success(new CustomerCityResource($updatedCustomerCity), 'CustomerCity updated successfully');
    }

    public function destroy(CustomerCity $customer_city): JsonResponse
    {
        $this->deleteAction->execute($customer_city);
        return $this->success(null, 'CustomerCity deleted successfully');
    }
}
