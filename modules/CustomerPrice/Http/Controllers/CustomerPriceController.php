<?php

namespace Modules\CustomerPrice\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\CustomerPrice\Actions\CustomerPriceDeleteAction;
use Modules\CustomerPrice\Actions\CustomerPriceListAction;
use Modules\CustomerPrice\Actions\CustomerPriceStoreAction;
use Modules\CustomerPrice\Actions\CustomerPriceUpdateAction;
use Modules\CustomerPrice\DataTransferObjects\CustomerPriceData;
use Modules\CustomerPrice\Http\Requests\CustomerPriceRequest;
use Modules\CustomerPrice\Http\Resources\CustomerPriceResource;
use Modules\CustomerPrice\Models\CustomerPrice;

class CustomerPriceController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly CustomerPriceListAction $listAction,
        private readonly CustomerPriceStoreAction $storeAction,
        private readonly CustomerPriceUpdateAction $updateAction,
        private readonly CustomerPriceDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $prices = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(CustomerPriceResource::collection($prices), 'Customer Prices retrieved successfully');
    }

    public function store(CustomerPriceRequest $request): JsonResponse
    {
        $data = CustomerPriceData::fromRequest($request);
        $price = $this->storeAction->execute($data);
        return $this->success(new CustomerPriceResource($price), 'Customer Price created successfully', 201);
    }

    public function show(CustomerPrice $customerPrice): JsonResponse
    {
        return $this->success(new CustomerPriceResource($customerPrice), 'Customer Price details retrieved');
    }

    public function update(CustomerPriceRequest $request, CustomerPrice $customerPrice): JsonResponse
    {
        $data = CustomerPriceData::fromRequest($request);
        $updatedPrice = $this->updateAction->execute($customerPrice, $data);
        return $this->success(new CustomerPriceResource($updatedPrice), 'Customer Price updated successfully');
    }

    public function destroy(CustomerPrice $customerPrice): JsonResponse
    {
        $this->deleteAction->execute($customerPrice);
        return $this->success(null, 'Customer Price deleted successfully');
    }
}
