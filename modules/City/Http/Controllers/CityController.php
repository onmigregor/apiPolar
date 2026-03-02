<?php

namespace Modules\City\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\City\Actions\CityDeleteAction;
use Modules\City\Actions\CityListAction;
use Modules\City\Actions\CityStoreAction;
use Modules\City\Actions\CityUpdateAction;
use Modules\City\DataTransferObjects\CityData;
use Modules\City\Http\Requests\CityRequest;
use Modules\City\Http\Resources\CityResource;
use Modules\City\Models\City;

class CityController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly CityListAction $listAction,
        private readonly CityStoreAction $storeAction,
        private readonly CityUpdateAction $updateAction,
        private readonly CityDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $cities = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(CityResource::collection($cities), 'Cities retrieved successfully');
    }

    public function store(CityRequest $request): JsonResponse
    {
        $data = CityData::fromRequest($request);
        $city = $this->storeAction->execute($data);
        return $this->success(new CityResource($city), 'City created successfully', 201);
    }

    public function show(City $city): JsonResponse
    {
        return $this->success(new CityResource($city), 'City details retrieved');
    }

    public function update(CityRequest $request, City $city): JsonResponse
    {
        $data = CityData::fromRequest($request);
        $updatedCity = $this->updateAction->execute($city, $data);
        return $this->success(new CityResource($updatedCity), 'City updated successfully');
    }

    public function destroy(City $city): JsonResponse
    {
        $this->deleteAction->execute($city);
        return $this->success(null, 'City deleted successfully');
    }
}
