<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Product\Actions\ProductDeleteAction;
use Modules\Product\Actions\ProductListAction;
use Modules\Product\Actions\ProductStoreAction;
use Modules\Product\Actions\ProductUpdateAction;
use Modules\Product\DataTransferObjects\ProductData;
use Modules\Product\Http\Requests\ProductRequest;
use Modules\Product\Http\Resources\ProductResource;
use Modules\Product\Models\Product;

class ProductController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly ProductListAction $listAction,
        private readonly ProductStoreAction $storeAction,
        private readonly ProductUpdateAction $updateAction,
        private readonly ProductDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $products = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(ProductResource::collection($products), 'Products retrieved successfully');
    }

    public function store(ProductRequest $request): JsonResponse
    {
        $data = ProductData::fromRequest($request);
        $product = $this->storeAction->execute($data);
        return $this->success(new ProductResource($product), 'Product created successfully', 201);
    }

    public function show(Product $product): JsonResponse
    {
        return $this->success(new ProductResource($product), 'Product details retrieved');
    }

    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $data = ProductData::fromRequest($request);
        $updatedProduct = $this->updateAction->execute($product, $data);
        return $this->success(new ProductResource($updatedProduct), 'Product updated successfully');
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->deleteAction->execute($product);
        return $this->success(null, 'Product deleted successfully');
    }
}
