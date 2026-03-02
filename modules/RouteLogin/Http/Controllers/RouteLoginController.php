<?php

namespace Modules\RouteLogin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\RouteLogin\Actions\RouteLoginDeleteAction;
use Modules\RouteLogin\Actions\RouteLoginListAction;
use Modules\RouteLogin\Actions\RouteLoginStoreAction;
use Modules\RouteLogin\Actions\RouteLoginUpdateAction;
use Modules\RouteLogin\DataTransferObjects\RouteLoginData;
use Modules\RouteLogin\Http\Requests\RouteLoginRequest;
use Modules\RouteLogin\Http\Resources\RouteLoginResource;
use Modules\RouteLogin\Models\RouteLogin;

class RouteLoginController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly RouteLoginListAction $listAction,
        private readonly RouteLoginStoreAction $storeAction,
        private readonly RouteLoginUpdateAction $updateAction,
        private readonly RouteLoginDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $routeLogins = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(RouteLoginResource::collection($routeLogins), 'Route Logins retrieved successfully');
    }

    public function store(RouteLoginRequest $request): JsonResponse
    {
        $data = RouteLoginData::fromRequest($request);
        $routeLogin = $this->storeAction->execute($data);
        return $this->success(new RouteLoginResource($routeLogin), 'Route Login created successfully', 201);
    }

    public function show(RouteLogin $routeLogin): JsonResponse
    {
        return $this->success(new RouteLoginResource($routeLogin), 'Route Login details retrieved');
    }

    public function update(RouteLoginRequest $request, RouteLogin $routeLogin): JsonResponse
    {
        $data = RouteLoginData::fromRequest($request);
        $updatedRouteLogin = $this->updateAction->execute($routeLogin, $data);
        return $this->success(new RouteLoginResource($updatedRouteLogin), 'Route Login updated successfully');
    }

    public function destroy(RouteLogin $routeLogin): JsonResponse
    {
        $this->deleteAction->execute($routeLogin);
        return $this->success(null, 'Route Login deleted successfully');
    }
}
