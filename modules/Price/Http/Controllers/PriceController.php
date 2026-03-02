<?php

namespace Modules\Price\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Price\Actions\PriceDeleteAction;
use Modules\Price\Actions\PriceListAction;
use Modules\Price\Actions\PriceStoreAction;
use Modules\Price\Actions\PriceUpdateAction;
use Modules\Price\DataTransferObjects\PriceData;
use Modules\Price\Http\Requests\PriceRequest;
use Modules\Price\Http\Resources\PriceResource;
use Modules\Price\Models\Price;

class PriceController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly PriceListAction $listAction,
        private readonly PriceStoreAction $storeAction,
        private readonly PriceUpdateAction $updateAction,
        private readonly PriceDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $prices = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(PriceResource::collection($prices), 'Prices retrieved successfully');
    }

    public function store(PriceRequest $request): JsonResponse
    {
        $data = PriceData::fromRequest($request);
        $price = $this->storeAction->execute($data);
        return $this->success(new PriceResource($price), 'Price created successfully', 201);
    }

    public function show(Price $price): JsonResponse
    {
        return $this->success(new PriceResource($price), 'Price details retrieved');
    }

    public function update(PriceRequest $request, Price $price): JsonResponse
    {
        $data = PriceData::fromRequest($request);
        $updatedPrice = $this->updateAction->execute($price, $data);
        return $this->success(new PriceResource($updatedPrice), 'Price updated successfully');
    }

    public function destroy(Price $price): JsonResponse
    {
        $this->deleteAction->execute($price);
        return $this->success(null, 'Price deleted successfully');
    }
}
