<?php

namespace Modules\DiscountDetailRoute\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\DiscountDetailRoute\Actions\DiscountDetailRouteDeleteAction;
use Modules\DiscountDetailRoute\Actions\DiscountDetailRouteListAction;
use Modules\DiscountDetailRoute\Actions\DiscountDetailRouteStoreAction;
use Modules\DiscountDetailRoute\Actions\DiscountDetailRouteUpdateAction;
use Modules\DiscountDetailRoute\DataTransferObjects\DiscountDetailRouteData;
use Modules\DiscountDetailRoute\Http\Requests\DiscountDetailRouteRequest;
use Modules\DiscountDetailRoute\Http\Resources\DiscountDetailRouteResource;
use Modules\DiscountDetailRoute\Models\DiscountDetailRoute;

class DiscountDetailRouteController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly DiscountDetailRouteListAction $listAction,
        private readonly DiscountDetailRouteStoreAction $storeAction,
        private readonly DiscountDetailRouteUpdateAction $updateAction,
        private readonly DiscountDetailRouteDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $discountDetailRoutes = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(DiscountDetailRouteResource::collection($discountDetailRoutes), 'Discount Detail Routes retrieved successfully');
    }

    public function store(DiscountDetailRouteRequest $request): JsonResponse
    {
        $data = DiscountDetailRouteData::fromRequest($request);
        $discountDetailRoute = $this->storeAction->execute($data);
        return $this->success(new DiscountDetailRouteResource($discountDetailRoute), 'Discount Detail Route created successfully', 201);
    }

    public function show(DiscountDetailRoute $discountDetailRoute): JsonResponse
    {
        return $this->success(new DiscountDetailRouteResource($discountDetailRoute), 'Discount Detail Route details retrieved');
    }

    public function update(DiscountDetailRouteRequest $request, DiscountDetailRoute $discountDetailRoute): JsonResponse
    {
        $data = DiscountDetailRouteData::fromRequest($request);
        $updatedDiscountDetailRoute = $this->updateAction->execute($discountDetailRoute, $data);
        return $this->success(new DiscountDetailRouteResource($updatedDiscountDetailRoute), 'Discount Detail Route updated successfully');
    }

    public function destroy(DiscountDetailRoute $discountDetailRoute): JsonResponse
    {
        $this->deleteAction->execute($discountDetailRoute);
        return $this->success(null, 'Discount Detail Route deleted successfully');
    }
}
