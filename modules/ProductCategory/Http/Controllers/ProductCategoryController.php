<?php

namespace Modules\ProductCategory\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\ProductCategory\Actions\ProductCategoryDeleteAction;
use Modules\ProductCategory\Actions\ProductCategoryListAction;
use Modules\ProductCategory\Actions\ProductCategoryStoreAction;
use Modules\ProductCategory\Actions\ProductCategoryUpdateAction;
use Modules\ProductCategory\DataTransferObjects\ProductCategoryData;
use Modules\ProductCategory\Http\Requests\ProductCategoryRequest;
use Modules\ProductCategory\Http\Resources\ProductCategoryResource;
use Modules\ProductCategory\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly ProductCategoryListAction $listAction,
        private readonly ProductCategoryStoreAction $storeAction,
        private readonly ProductCategoryUpdateAction $updateAction,
        private readonly ProductCategoryDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $items = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(ProductCategoryResource::collection($items), 'Product categories retrieved successfully');
    }

    public function store(ProductCategoryRequest $request): JsonResponse
    {
        $data = ProductCategoryData::fromRequest($request);
        $item = $this->storeAction->execute($data);
        return $this->success(new ProductCategoryResource($item), 'Product category created successfully', 201);
    }

    public function show(ProductCategory $productCategory): JsonResponse
    {
        return $this->success(new ProductCategoryResource($productCategory), 'Product category details retrieved');
    }

    public function update(ProductCategoryRequest $request, ProductCategory $productCategory): JsonResponse
    {
        $data = ProductCategoryData::fromRequest($request);
        $updated = $this->updateAction->execute($productCategory, $data);
        return $this->success(new ProductCategoryResource($updated), 'Product category updated successfully');
    }

    public function destroy(ProductCategory $productCategory): JsonResponse
    {
        $this->deleteAction->execute($productCategory);
        return $this->success(null, 'Product category deleted successfully');
    }
}
