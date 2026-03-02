<?php

namespace Modules\TaxationTax\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\TaxationTax\Actions\TaxationTaxDeleteAction;
use Modules\TaxationTax\Actions\TaxationTaxListAction;
use Modules\TaxationTax\Actions\TaxationTaxStoreAction;
use Modules\TaxationTax\Actions\TaxationTaxUpdateAction;
use Modules\TaxationTax\DataTransferObjects\TaxationTaxData;
use Modules\TaxationTax\Http\Requests\TaxationTaxRequest;
use Modules\TaxationTax\Http\Resources\TaxationTaxResource;
use Modules\TaxationTax\Models\TaxationTax;

class TaxationTaxController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly TaxationTaxListAction $listAction,
        private readonly TaxationTaxStoreAction $storeAction,
        private readonly TaxationTaxUpdateAction $updateAction,
        private readonly TaxationTaxDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $taxationTaxes = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(TaxationTaxResource::collection($taxationTaxes), 'Taxation Taxes retrieved successfully');
    }

    public function store(TaxationTaxRequest $request): JsonResponse
    {
        $data = TaxationTaxData::fromRequest($request);
        $taxationTax = $this->storeAction->execute($data);
        return $this->success(new TaxationTaxResource($taxationTax), 'Taxation Tax created successfully', 201);
    }

    public function show(TaxationTax $taxationTax): JsonResponse
    {
        return $this->success(new TaxationTaxResource($taxationTax), 'Taxation Tax details retrieved');
    }

    public function update(TaxationTaxRequest $request, TaxationTax $taxationTax): JsonResponse
    {
        $data = TaxationTaxData::fromRequest($request);
        $updatedTaxationTax = $this->updateAction->execute($taxationTax, $data);
        return $this->success(new TaxationTaxResource($updatedTaxationTax), 'Taxation Tax updated successfully');
    }

    public function destroy(TaxationTax $taxationTax): JsonResponse
    {
        $this->deleteAction->execute($taxationTax);
        return $this->success(null, 'Taxation Tax deleted successfully');
    }
}
