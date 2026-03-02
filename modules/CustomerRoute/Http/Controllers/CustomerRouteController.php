<?php

namespace Modules\CustomerRoute\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\CustomerRoute\Actions\CustomerRouteDeleteAction;
use Modules\CustomerRoute\Actions\CustomerRouteListAction;
use Modules\CustomerRoute\Actions\CustomerRouteStoreAction;
use Modules\CustomerRoute\Actions\CustomerRouteUpdateAction;
use Modules\CustomerRoute\DataTransferObjects\CustomerRouteData;
use Modules\CustomerRoute\Http\Requests\CustomerRouteRequest;
use Modules\CustomerRoute\Http\Resources\CustomerRouteResource;
use Modules\CustomerRoute\Models\CustomerRoute;

class CustomerRouteController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly CustomerRouteListAction $listAction,
        private readonly CustomerRouteStoreAction $storeAction,
        private readonly CustomerRouteUpdateAction $updateAction,
        private readonly CustomerRouteDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $routes = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(CustomerRouteResource::collection($routes), 'Customer Routes retrieved successfully');
    }

    public function store(CustomerRouteRequest $request): JsonResponse
    {
        $data = CustomerRouteData::fromRequest($request);
        $route = $this->storeAction->execute($data);
        return $this->success(new CustomerRouteResource($route), 'Customer Route created successfully', 201);
    }

    public function show(CustomerRoute $customerRoute): JsonResponse
    {
        return $this->success(new CustomerRouteResource($customerRoute), 'Customer Route details retrieved');
    }

    public function update(CustomerRouteRequest $request, CustomerRoute $customerRoute): JsonResponse
    {
        $data = CustomerRouteData::fromRequest($request);
        $route = $this->updateAction->execute($customerRoute, $data);
        return $this->success(new CustomerRouteResource($route), 'Customer Route updated successfully');
    }

    public function destroy(CustomerRoute $customerRoute): JsonResponse
    {
        $this->deleteAction->execute($customerRoute);
        return $this->success(null, 'Customer Route deleted successfully');
    }
}
