<?php

namespace Modules\ProductUnit\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\ProductUnit\Actions\ProductUnitDeleteAction;
use Modules\ProductUnit\Actions\ProductUnitListAction;
use Modules\ProductUnit\Actions\ProductUnitStoreAction;
use Modules\ProductUnit\Actions\ProductUnitUpdateAction;
use Modules\ProductUnit\DataTransferObjects\ProductUnitData;
use Modules\ProductUnit\Http\Requests\ProductUnitRequest;
use Modules\ProductUnit\Http\Resources\ProductUnitResource;
use Modules\ProductUnit\Models\ProductUnit;

class ProductUnitController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly ProductUnitListAction $listAction,
        private readonly ProductUnitStoreAction $storeAction,
        private readonly ProductUnitUpdateAction $updateAction,
        private readonly ProductUnitDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $productUnits = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(ProductUnitResource::collection($productUnits), 'Product Units retrieved successfully');
    }

    public function store(ProductUnitRequest $request): JsonResponse
    {
        $data = ProductUnitData::fromRequest($request);
        $productUnit = $this->storeAction->execute($data);
        return $this->success(new ProductUnitResource($productUnit), 'Product Unit created successfully', 201);
    }

    public function show(ProductUnit $productUnit): JsonResponse
    {
        return $this->success(new ProductUnitResource($productUnit), 'Product Unit details retrieved');
    }

    public function update(ProductUnitRequest $request, ProductUnit $productUnit): JsonResponse
    {
        $data = ProductUnitData::fromRequest($request);
        $updatedProductUnit = $this->updateAction->execute($productUnit, $data);
        return $this->success(new ProductUnitResource($updatedProductUnit), 'Product Unit updated successfully');
    }

    public function destroy(ProductUnit $productUnit): JsonResponse
    {
        $this->deleteAction->execute($productUnit);
        return $this->success(null, 'Product Unit deleted successfully');
    }
}
