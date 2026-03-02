<?php

namespace Modules\RouteGeneral\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\RouteGeneral\Actions\RouteGeneralDeleteAction;
use Modules\RouteGeneral\Actions\RouteGeneralListAction;
use Modules\RouteGeneral\Actions\RouteGeneralStoreAction;
use Modules\RouteGeneral\Actions\RouteGeneralUpdateAction;
use Modules\RouteGeneral\DataTransferObjects\RouteGeneralData;
use Modules\RouteGeneral\Http\Requests\RouteGeneralRequest;
use Modules\RouteGeneral\Http\Resources\RouteGeneralResource;
use Modules\RouteGeneral\Models\RouteGeneral;

class RouteGeneralController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly RouteGeneralListAction $listAction,
        private readonly RouteGeneralStoreAction $storeAction,
        private readonly RouteGeneralUpdateAction $updateAction,
        private readonly RouteGeneralDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $generals = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(RouteGeneralResource::collection($generals), 'Route Generals retrieved successfully');
    }

    public function store(RouteGeneralRequest $request): JsonResponse
    {
        $data = RouteGeneralData::fromRequest($request);
        $general = $this->storeAction->execute($data);
        return $this->success(new RouteGeneralResource($general), 'Route General created successfully', 201);
    }

    public function show(RouteGeneral $routeGeneral): JsonResponse
    {
        return $this->success(new RouteGeneralResource($routeGeneral), 'Route General details retrieved');
    }

    public function update(RouteGeneralRequest $request, RouteGeneral $routeGeneral): JsonResponse
    {
        $data = RouteGeneralData::fromRequest($request);
        $updatedGeneral = $this->updateAction->execute($routeGeneral, $data);
        return $this->success(new RouteGeneralResource($updatedGeneral), 'Route General updated successfully');
    }

    public function destroy(RouteGeneral $routeGeneral): JsonResponse
    {
        $this->deleteAction->execute($routeGeneral);
        return $this->success(null, 'Route General deleted successfully');
    }
}
