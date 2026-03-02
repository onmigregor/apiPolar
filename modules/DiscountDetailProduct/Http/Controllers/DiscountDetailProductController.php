<?php

namespace Modules\DiscountDetailProduct\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\DiscountDetailProduct\Actions\DiscountDetailProductDeleteAction;
use Modules\DiscountDetailProduct\Actions\DiscountDetailProductListAction;
use Modules\DiscountDetailProduct\Actions\DiscountDetailProductStoreAction;
use Modules\DiscountDetailProduct\Actions\DiscountDetailProductUpdateAction;
use Modules\DiscountDetailProduct\DataTransferObjects\DiscountDetailProductData;
use Modules\DiscountDetailProduct\Http\Requests\DiscountDetailProductRequest;
use Modules\DiscountDetailProduct\Http\Resources\DiscountDetailProductResource;
use Modules\DiscountDetailProduct\Models\DiscountDetailProduct;

class DiscountDetailProductController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly DiscountDetailProductListAction $listAction,
        private readonly DiscountDetailProductStoreAction $storeAction,
        private readonly DiscountDetailProductUpdateAction $updateAction,
        private readonly DiscountDetailProductDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $discountDetailProducts = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(DiscountDetailProductResource::collection($discountDetailProducts), 'Discount Detail Products retrieved successfully');
    }

    public function store(DiscountDetailProductRequest $request): JsonResponse
    {
        $data = DiscountDetailProductData::fromRequest($request);
        $discountDetailProduct = $this->storeAction->execute($data);
        return $this->success(new DiscountDetailProductResource($discountDetailProduct), 'Discount Detail Product created successfully', 201);
    }

    public function show(DiscountDetailProduct $discountDetailProduct): JsonResponse
    {
        return $this->success(new DiscountDetailProductResource($discountDetailProduct), 'Discount Detail Product retrieve successfully');
    }

    public function update(DiscountDetailProductRequest $request, DiscountDetailProduct $discountDetailProduct): JsonResponse
    {
        $data = DiscountDetailProductData::fromRequest($request);
        $updatedDiscountDetailProduct = $this->updateAction->execute($discountDetailProduct, $data);
        return $this->success(new DiscountDetailProductResource($updatedDiscountDetailProduct), 'Discount Detail Product updated successfully');
    }

    public function destroy(DiscountDetailProduct $discountDetailProduct): JsonResponse
    {
        $this->deleteAction->execute($discountDetailProduct);
        return $this->success(null, 'Discount Detail Product deleted successfully');
    }
}
