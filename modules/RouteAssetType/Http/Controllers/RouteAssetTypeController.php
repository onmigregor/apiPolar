<?php

namespace Modules\RouteAssetType\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\RouteAssetType\Actions\RouteAssetTypeDeleteAction;
use Modules\RouteAssetType\Actions\RouteAssetTypeListAction;
use Modules\RouteAssetType\Actions\RouteAssetTypeStoreAction;
use Modules\RouteAssetType\Actions\RouteAssetTypeUpdateAction;
use Modules\RouteAssetType\DataTransferObjects\RouteAssetTypeData;
use Modules\RouteAssetType\Http\Requests\RouteAssetTypeRequest;
use Modules\RouteAssetType\Http\Resources\RouteAssetTypeResource;
use Modules\RouteAssetType\Models\RouteAssetType;

class RouteAssetTypeController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly RouteAssetTypeListAction $listAction,
        private readonly RouteAssetTypeStoreAction $storeAction,
        private readonly RouteAssetTypeUpdateAction $updateAction,
        private readonly RouteAssetTypeDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $types = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(RouteAssetTypeResource::collection($types), 'Route Asset Types retrieved successfully');
    }

    public function store(RouteAssetTypeRequest $request): JsonResponse
    {
        $data = RouteAssetTypeData::fromRequest($request);
        $type = $this->storeAction->execute($data);
        return $this->success(new RouteAssetTypeResource($type), 'Route Asset Type created successfully', 201);
    }

    public function show(RouteAssetType $routeAssetType): JsonResponse
    {
        return $this->success(new RouteAssetTypeResource($routeAssetType), 'Route Asset Type details retrieved');
    }

    public function update(RouteAssetTypeRequest $request, RouteAssetType $routeAssetType): JsonResponse
    {
        $data = RouteAssetTypeData::fromRequest($request);
        $updatedType = $this->updateAction->execute($routeAssetType, $data);
        return $this->success(new RouteAssetTypeResource($updatedType), 'Route Asset Type updated successfully');
    }

    public function destroy(RouteAssetType $routeAssetType): JsonResponse
    {
        $this->deleteAction->execute($routeAssetType);
        return $this->success(null, 'Route Asset Type deleted successfully');
    }
}
