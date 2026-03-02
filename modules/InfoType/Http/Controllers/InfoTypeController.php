<?php

namespace Modules\InfoType\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\InfoType\Actions\InfoTypeDeleteAction;
use Modules\InfoType\Actions\InfoTypeListAction;
use Modules\InfoType\Actions\InfoTypeStoreAction;
use Modules\InfoType\Actions\InfoTypeUpdateAction;
use Modules\InfoType\DataTransferObjects\InfoTypeData;
use Modules\InfoType\Http\Requests\InfoTypeRequest;
use Modules\InfoType\Http\Resources\InfoTypeResource;
use Modules\InfoType\Models\InfoType;

class InfoTypeController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly InfoTypeListAction $listAction,
        private readonly InfoTypeStoreAction $storeAction,
        private readonly InfoTypeUpdateAction $updateAction,
        private readonly InfoTypeDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $infoTypes = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(InfoTypeResource::collection($infoTypes), 'Info Types retrieved successfully');
    }

    public function store(InfoTypeRequest $request): JsonResponse
    {
        $data = InfoTypeData::fromRequest($request);
        $infoType = $this->storeAction->execute($data);
        return $this->success(new InfoTypeResource($infoType), 'Info Type created successfully', 201);
    }

    public function show(InfoType $infoType): JsonResponse
    {
        return $this->success(new InfoTypeResource($infoType), 'Info Type details retrieved');
    }

    public function update(InfoTypeRequest $request, InfoType $infoType): JsonResponse
    {
        $data = InfoTypeData::fromRequest($request);
        $updatedType = $this->updateAction->execute($infoType, $data);
        return $this->success(new InfoTypeResource($updatedType), 'Info Type updated successfully');
    }

    public function destroy(InfoType $infoType): JsonResponse
    {
        $this->deleteAction->execute($infoType);
        return $this->success(null, 'Info Type deleted successfully');
    }
}
