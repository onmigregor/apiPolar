<?php

namespace Modules\DiscountDetail\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\DiscountDetail\Actions\DiscountDetailDeleteAction;
use Modules\DiscountDetail\Actions\DiscountDetailListAction;
use Modules\DiscountDetail\Actions\DiscountDetailStoreAction;
use Modules\DiscountDetail\Actions\DiscountDetailUpdateAction;
use Modules\DiscountDetail\DataTransferObjects\DiscountDetailData;
use Modules\DiscountDetail\Http\Requests\DiscountDetailRequest;
use Modules\DiscountDetail\Http\Resources\DiscountDetailResource;
use Modules\DiscountDetail\Models\DiscountDetail;

class DiscountDetailController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly DiscountDetailListAction $listAction,
        private readonly DiscountDetailStoreAction $storeAction,
        private readonly DiscountDetailUpdateAction $updateAction,
        private readonly DiscountDetailDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $discountDetails = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(DiscountDetailResource::collection($discountDetails), 'Discount Details retrieved successfully');
    }

    public function store(DiscountDetailRequest $request): JsonResponse
    {
        $data = DiscountDetailData::fromRequest($request);
        $discountDetail = $this->storeAction->execute($data);
        return $this->success(new DiscountDetailResource($discountDetail), 'Discount Detail created successfully', 201);
    }

    public function show(DiscountDetail $discountDetail): JsonResponse
    {
        return $this->success(new DiscountDetailResource($discountDetail), 'Discount Detail retrieve successfully');
    }

    public function update(DiscountDetailRequest $request, DiscountDetail $discountDetail): JsonResponse
    {
        $data = DiscountDetailData::fromRequest($request);
        $updatedDiscountDetail = $this->updateAction->execute($discountDetail, $data);
        return $this->success(new DiscountDetailResource($updatedDiscountDetail), 'Discount Detail updated successfully');
    }

    public function destroy(DiscountDetail $discountDetail): JsonResponse
    {
        $this->deleteAction->execute($discountDetail);
        return $this->success(null, 'Discount Detail deleted successfully');
    }
}
