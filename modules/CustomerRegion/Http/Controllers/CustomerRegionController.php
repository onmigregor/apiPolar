<?php

namespace Modules\CustomerRegion\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\CustomerRegion\Actions\CustomerRegionDeleteAction;
use Modules\CustomerRegion\Actions\CustomerRegionListAction;
use Modules\CustomerRegion\Actions\CustomerRegionStoreAction;
use Modules\CustomerRegion\Actions\CustomerRegionUpdateAction;
use Modules\CustomerRegion\DataTransferObjects\CustomerRegionData;
use Modules\CustomerRegion\Http\Requests\CustomerRegionRequest;
use Modules\CustomerRegion\Http\Resources\CustomerRegionResource;
use Modules\CustomerRegion\Models\CustomerRegion;

class CustomerRegionController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly CustomerRegionListAction $listAction,
        private readonly CustomerRegionStoreAction $storeAction,
        private readonly CustomerRegionUpdateAction $updateAction,
        private readonly CustomerRegionDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $regions = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(CustomerRegionResource::collection($regions), 'Customer Regions retrieved successfully');
    }

    public function store(CustomerRegionRequest $request): JsonResponse
    {
        $data = CustomerRegionData::fromRequest($request);
        $region = $this->storeAction->execute($data);
        return $this->success(new CustomerRegionResource($region), 'Customer Region created successfully', 201);
    }

    public function show(CustomerRegion $customerRegion): JsonResponse
    {
        return $this->success(new CustomerRegionResource($customerRegion), 'Customer Region details retrieved');
    }

    public function update(CustomerRegionRequest $request, CustomerRegion $customerRegion): JsonResponse
    {
        $data = CustomerRegionData::fromRequest($request);
        $region = $this->updateAction->execute($customerRegion, $data);
        return $this->success(new CustomerRegionResource($region), 'Customer Region updated successfully');
    }

    public function destroy(CustomerRegion $customerRegion): JsonResponse
    {
        $this->deleteAction->execute($customerRegion);
        return $this->success(null, 'Customer Region deleted successfully');
    }
}
