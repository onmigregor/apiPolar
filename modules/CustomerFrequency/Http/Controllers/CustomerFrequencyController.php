<?php

namespace Modules\CustomerFrequency\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\CustomerFrequency\Actions\CustomerFrequencyDeleteAction;
use Modules\CustomerFrequency\Actions\CustomerFrequencyListAction;
use Modules\CustomerFrequency\Actions\CustomerFrequencyStoreAction;
use Modules\CustomerFrequency\Actions\CustomerFrequencyUpdateAction;
use Modules\CustomerFrequency\DataTransferObjects\CustomerFrequencyData;
use Modules\CustomerFrequency\Http\Requests\CustomerFrequencyRequest;
use Modules\CustomerFrequency\Http\Resources\CustomerFrequencyResource;
use Modules\CustomerFrequency\Models\CustomerFrequency;

class CustomerFrequencyController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly CustomerFrequencyListAction $listAction,
        private readonly CustomerFrequencyStoreAction $storeAction,
        private readonly CustomerFrequencyUpdateAction $updateAction,
        private readonly CustomerFrequencyDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $frequencies = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(CustomerFrequencyResource::collection($frequencies), 'Customer Frequencies retrieved successfully');
    }

    public function store(CustomerFrequencyRequest $request): JsonResponse
    {
        $data = CustomerFrequencyData::fromRequest($request);
        $frequency = $this->storeAction->execute($data);
        return $this->success(new CustomerFrequencyResource($frequency), 'Customer Frequency created successfully', 201);
    }

    public function show(CustomerFrequency $customerFrequency): JsonResponse
    {
        return $this->success(new CustomerFrequencyResource($customerFrequency), 'Customer Frequency details retrieved');
    }

    public function update(CustomerFrequencyRequest $request, CustomerFrequency $customerFrequency): JsonResponse
    {
        $data = CustomerFrequencyData::fromRequest($request);
        $frequency = $this->updateAction->execute($customerFrequency, $data);
        return $this->success(new CustomerFrequencyResource($frequency), 'Customer Frequency updated successfully');
    }

    public function destroy(CustomerFrequency $customerFrequency): JsonResponse
    {
        $this->deleteAction->execute($customerFrequency);
        return $this->success(null, 'Customer Frequency deleted successfully');
    }
}
