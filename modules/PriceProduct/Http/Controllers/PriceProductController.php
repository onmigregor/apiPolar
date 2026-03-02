<?php

namespace Modules\PriceProduct\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\PriceProduct\Actions\PriceProductDeleteAction;
use Modules\PriceProduct\Actions\PriceProductListAction;
use Modules\PriceProduct\Actions\PriceProductStoreAction;
use Modules\PriceProduct\Actions\PriceProductUpdateAction;
use Modules\PriceProduct\DataTransferObjects\PriceProductData;
use Modules\PriceProduct\Http\Requests\PriceProductRequest;
use Modules\PriceProduct\Http\Resources\PriceProductResource;
use Modules\PriceProduct\Models\PriceProduct;

class PriceProductController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly PriceProductListAction $listAction,
        private readonly PriceProductStoreAction $storeAction,
        private readonly PriceProductUpdateAction $updateAction,
        private readonly PriceProductDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $priceProducts = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(PriceProductResource::collection($priceProducts), 'Price Products retrieved successfully');
    }

    public function store(PriceProductRequest $request): JsonResponse
    {
        $data = PriceProductData::fromRequest($request);
        $priceProduct = $this->storeAction->execute($data);
        return $this->success(new PriceProductResource($priceProduct), 'Price Product created successfully', 201);
    }

    public function show(PriceProduct $priceProduct): JsonResponse
    {
        return $this->success(new PriceProductResource($priceProduct), 'Price Product details retrieved');
    }

    public function update(PriceProductRequest $request, PriceProduct $priceProduct): JsonResponse
    {
        $data = PriceProductData::fromRequest($request);
        $updatedPriceProduct = $this->updateAction->execute($priceProduct, $data);
        return $this->success(new PriceProductResource($updatedPriceProduct), 'Price Product updated successfully');
    }

    public function destroy(PriceProduct $priceProduct): JsonResponse
    {
        $this->deleteAction->execute($priceProduct);
        return $this->success(null, 'Price Product deleted successfully');
    }
}
