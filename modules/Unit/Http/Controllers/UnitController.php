<?php

namespace Modules\Unit\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Unit\Actions\UnitDeleteAction;
use Modules\Unit\Actions\UnitListAction;
use Modules\Unit\Actions\UnitStoreAction;
use Modules\Unit\Actions\UnitUpdateAction;
use Modules\Unit\DataTransferObjects\UnitData;
use Modules\Unit\Http\Requests\UnitRequest;
use Modules\Unit\Http\Resources\UnitResource;
use Modules\Unit\Models\Unit;

class UnitController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly UnitListAction $listAction,
        private readonly UnitStoreAction $storeAction,
        private readonly UnitUpdateAction $updateAction,
        private readonly UnitDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $units = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(UnitResource::collection($units), 'Units retrieved successfully');
    }

    public function store(UnitRequest $request): JsonResponse
    {
        $data = UnitData::fromRequest($request);
        $unit = $this->storeAction->execute($data);
        return $this->success(new UnitResource($unit), 'Unit created successfully', 201);
    }

    public function show(Unit $unit): JsonResponse
    {
        return $this->success(new UnitResource($unit), 'Unit details retrieved');
    }

    public function update(UnitRequest $request, Unit $unit): JsonResponse
    {
        $data = UnitData::fromRequest($request);
        $updatedUnit = $this->updateAction->execute($unit, $data);
        return $this->success(new UnitResource($updatedUnit), 'Unit updated successfully');
    }

    public function destroy(Unit $unit): JsonResponse
    {
        $this->deleteAction->execute($unit);
        return $this->success(null, 'Unit deleted successfully');
    }
}
