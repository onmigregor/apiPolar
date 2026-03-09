<?php

namespace Modules\ProductFamily\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\ProductFamily\Actions\ProductFamilyDeleteAction;
use Modules\ProductFamily\Actions\ProductFamilyListAction;
use Modules\ProductFamily\Actions\ProductFamilyStoreAction;
use Modules\ProductFamily\Actions\ProductFamilyUpdateAction;
use Modules\ProductFamily\DataTransferObjects\ProductFamilyData;
use Modules\ProductFamily\Http\Requests\ProductFamilyRequest;
use Modules\ProductFamily\Http\Resources\ProductFamilyResource;
use Modules\ProductFamily\Models\ProductFamily;

class ProductFamilyController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly ProductFamilyListAction $listAction,
        private readonly ProductFamilyStoreAction $storeAction,
        private readonly ProductFamilyUpdateAction $updateAction,
        private readonly ProductFamilyDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $items = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(ProductFamilyResource::collection($items), 'Product families retrieved successfully');
    }

    public function store(ProductFamilyRequest $request): JsonResponse
    {
        $data = ProductFamilyData::fromRequest($request);
        $item = $this->storeAction->execute($data);
        return $this->success(new ProductFamilyResource($item), 'Product family created successfully', 201);
    }

    public function show(ProductFamily $productFamily): JsonResponse
    {
        return $this->success(new ProductFamilyResource($productFamily), 'Product family details retrieved');
    }

    public function update(ProductFamilyRequest $request, ProductFamily $productFamily): JsonResponse
    {
        $data = ProductFamilyData::fromRequest($request);
        $updated = $this->updateAction->execute($productFamily, $data);
        return $this->success(new ProductFamilyResource($updated), 'Product family updated successfully');
    }

    public function destroy(ProductFamily $productFamily): JsonResponse
    {
        $this->deleteAction->execute($productFamily);
        return $this->success(null, 'Product family deleted successfully');
    }
}
