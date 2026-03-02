<?php

namespace Modules\CustomerInfo\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\CustomerInfo\Actions\CustomerInfoDeleteAction;
use Modules\CustomerInfo\Actions\CustomerInfoListAction;
use Modules\CustomerInfo\Actions\CustomerInfoStoreAction;
use Modules\CustomerInfo\Actions\CustomerInfoUpdateAction;
use Modules\CustomerInfo\DataTransferObjects\CustomerInfoData;
use Modules\CustomerInfo\Http\Requests\CustomerInfoRequest;
use Modules\CustomerInfo\Http\Resources\CustomerInfoResource;
use Modules\CustomerInfo\Models\CustomerInfo;

class CustomerInfoController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly CustomerInfoListAction $listAction,
        private readonly CustomerInfoStoreAction $storeAction,
        private readonly CustomerInfoUpdateAction $updateAction,
        private readonly CustomerInfoDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $infos = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(CustomerInfoResource::collection($infos), 'Customer Infos retrieved successfully');
    }

    public function store(CustomerInfoRequest $request): JsonResponse
    {
        $data = CustomerInfoData::fromRequest($request);
        $info = $this->storeAction->execute($data);
        return $this->success(new CustomerInfoResource($info), 'Customer Info created successfully', 201);
    }

    public function show(CustomerInfo $customerInfo): JsonResponse
    {
        return $this->success(new CustomerInfoResource($customerInfo), 'Customer Info details retrieved');
    }

    public function update(CustomerInfoRequest $request, CustomerInfo $customerInfo): JsonResponse
    {
        $data = CustomerInfoData::fromRequest($request);
        $updatedInfo = $this->updateAction->execute($customerInfo, $data);
        return $this->success(new CustomerInfoResource($updatedInfo), 'Customer Info updated successfully');
    }

    public function destroy(CustomerInfo $customerInfo): JsonResponse
    {
        $this->deleteAction->execute($customerInfo);
        return $this->success(null, 'Customer Info deleted successfully');
    }
}
