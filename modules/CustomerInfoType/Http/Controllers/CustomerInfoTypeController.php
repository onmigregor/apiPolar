<?php

namespace Modules\CustomerInfoType\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\CustomerInfoType\Actions\CustomerInfoTypeDeleteAction;
use Modules\CustomerInfoType\Actions\CustomerInfoTypeListAction;
use Modules\CustomerInfoType\Actions\CustomerInfoTypeStoreAction;
use Modules\CustomerInfoType\Actions\CustomerInfoTypeUpdateAction;
use Modules\CustomerInfoType\DataTransferObjects\CustomerInfoTypeData;
use Modules\CustomerInfoType\Http\Requests\CustomerInfoTypeRequest;
use Modules\CustomerInfoType\Http\Resources\CustomerInfoTypeResource;
use Modules\CustomerInfoType\Models\CustomerInfoType;

class CustomerInfoTypeController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly CustomerInfoTypeListAction $listAction,
        private readonly CustomerInfoTypeStoreAction $storeAction,
        private readonly CustomerInfoTypeUpdateAction $updateAction,
        private readonly CustomerInfoTypeDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $customerInfoTypes = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(CustomerInfoTypeResource::collection($customerInfoTypes), 'Info Types retrieved successfully');
    }

    public function store(CustomerInfoTypeRequest $request): JsonResponse
    {
        $data = CustomerInfoTypeData::fromRequest($request);
        $customerInfoType = $this->storeAction->execute($data);
        return $this->success(new CustomerInfoTypeResource($customerInfoType), 'Info Type created successfully', 201);
    }

    public function show(CustomerInfoType $customerInfoType): JsonResponse
    {
        return $this->success(new CustomerInfoTypeResource($customerInfoType), 'Info Type details retrieved');
    }

    public function update(CustomerInfoTypeRequest $request, CustomerInfoType $customerInfoType): JsonResponse
    {
        $data = CustomerInfoTypeData::fromRequest($request);
        $updatedType = $this->updateAction->execute($customerInfoType, $data);
        return $this->success(new CustomerInfoTypeResource($updatedType), 'Info Type updated successfully');
    }

    public function destroy(CustomerInfoType $customerInfoType): JsonResponse
    {
        $this->deleteAction->execute($customerInfoType);
        return $this->success(null, 'Info Type deleted successfully');
    }
}
