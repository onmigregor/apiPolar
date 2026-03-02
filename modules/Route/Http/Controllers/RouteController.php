<?php

namespace Modules\Route\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Route\Actions\RouteDeleteAction;
use Modules\Route\Actions\RouteListAction;
use Modules\Route\Actions\RouteStoreAction;
use Modules\Route\Actions\RouteUpdateAction;
use Modules\Route\DataTransferObjects\RouteData;
use Modules\Route\Http\Requests\RouteRequest;
use Modules\Route\Http\Resources\RouteResource;
use Modules\Route\Models\Route;

class RouteController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly RouteListAction $listAction,
        private readonly RouteStoreAction $storeAction,
        private readonly RouteUpdateAction $updateAction,
        private readonly RouteDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $routes = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(RouteResource::collection($routes), 'Routes retrieved successfully');
    }

    public function store(RouteRequest $request): JsonResponse
    {
        $data = RouteData::fromRequest($request);
        $route = $this->storeAction->execute($data);
        return $this->success(new RouteResource($route), 'Route created successfully', 201);
    }

    public function show(Route $route): JsonResponse
    {
        return $this->success(new RouteResource($route), 'Route details retrieved');
    }

    public function update(RouteRequest $request, Route $route): JsonResponse
    {
        $data = RouteData::fromRequest($request);
        $updatedRoute = $this->updateAction->execute($route, $data);
        return $this->success(new RouteResource($updatedRoute), 'Route updated successfully');
    }

    public function destroy(Route $route): JsonResponse
    {
        $this->deleteAction->execute($route);
        return $this->success(null, 'Route deleted successfully');
    }
}
