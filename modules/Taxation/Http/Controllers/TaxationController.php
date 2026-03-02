<?php

namespace Modules\Taxation\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Taxation\Actions\TaxationDeleteAction;
use Modules\Taxation\Actions\TaxationListAction;
use Modules\Taxation\Actions\TaxationStoreAction;
use Modules\Taxation\Actions\TaxationUpdateAction;
use Modules\Taxation\DataTransferObjects\TaxationData;
use Modules\Taxation\Http\Requests\TaxationRequest;
use Modules\Taxation\Http\Resources\TaxationResource;
use Modules\Taxation\Models\Taxation;

class TaxationController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly TaxationListAction $listAction,
        private readonly TaxationStoreAction $storeAction,
        private readonly TaxationUpdateAction $updateAction,
        private readonly TaxationDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $taxations = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(TaxationResource::collection($taxations), 'Taxations retrieved successfully');
    }

    public function store(TaxationRequest $request): JsonResponse
    {
        $data = TaxationData::fromRequest($request);
        $taxation = $this->storeAction->execute($data);
        return $this->success(new TaxationResource($taxation), 'Taxation created successfully', 201);
    }

    public function show(Taxation $taxation): JsonResponse
    {
        return $this->success(new TaxationResource($taxation), 'Taxation details retrieved');
    }

    public function update(TaxationRequest $request, Taxation $taxation): JsonResponse
    {
        $data = TaxationData::fromRequest($request);
        $updatedTaxation = $this->updateAction->execute($taxation, $data);
        return $this->success(new TaxationResource($updatedTaxation), 'Taxation updated successfully');
    }

    public function destroy(Taxation $taxation): JsonResponse
    {
        $this->deleteAction->execute($taxation);
        return $this->success(null, 'Taxation deleted successfully');
    }
}
