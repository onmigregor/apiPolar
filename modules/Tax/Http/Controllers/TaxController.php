<?php

namespace Modules\Tax\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Tax\Actions\TaxDeleteAction;
use Modules\Tax\Actions\TaxListAction;
use Modules\Tax\Actions\TaxStoreAction;
use Modules\Tax\Actions\TaxUpdateAction;
use Modules\Tax\DataTransferObjects\TaxData;
use Modules\Tax\Http\Requests\TaxRequest;
use Modules\Tax\Http\Resources\TaxResource;
use Modules\Tax\Models\Tax;

class TaxController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly TaxListAction $listAction,
        private readonly TaxStoreAction $storeAction,
        private readonly TaxUpdateAction $updateAction,
        private readonly TaxDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $taxes = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(TaxResource::collection($taxes), 'Taxes retrieved successfully');
    }

    public function store(TaxRequest $request): JsonResponse
    {
        $data = TaxData::fromRequest($request);
        $tax = $this->storeAction->execute($data);
        return $this->success(new TaxResource($tax), 'Tax created successfully', 201);
    }

    public function show(Tax $tax): JsonResponse
    {
        return $this->success(new TaxResource($tax), 'Tax details retrieved');
    }

    public function update(TaxRequest $request, Tax $tax): JsonResponse
    {
        $data = TaxData::fromRequest($request);
        $updatedTax = $this->updateAction->execute($tax, $data);
        return $this->success(new TaxResource($updatedTax), 'Tax updated successfully');
    }

    public function destroy(Tax $tax): JsonResponse
    {
        $this->deleteAction->execute($tax);
        return $this->success(null, 'Tax deleted successfully');
    }
}
