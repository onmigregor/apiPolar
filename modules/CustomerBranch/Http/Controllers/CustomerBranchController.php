<?php

namespace Modules\CustomerBranch\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\CustomerBranch\Actions\CustomerBranchDeleteAction;
use Modules\CustomerBranch\Actions\CustomerBranchListAction;
use Modules\CustomerBranch\Actions\CustomerBranchStoreAction;
use Modules\CustomerBranch\Actions\CustomerBranchUpdateAction;
use Modules\CustomerBranch\DataTransferObjects\CustomerBranchData;
use Modules\CustomerBranch\Http\Requests\CustomerBranchRequest;
use Modules\CustomerBranch\Http\Resources\CustomerBranchResource;
use Modules\CustomerBranch\Models\CustomerBranch;

class CustomerBranchController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly CustomerBranchListAction $listAction,
        private readonly CustomerBranchStoreAction $storeAction,
        private readonly CustomerBranchUpdateAction $updateAction,
        private readonly CustomerBranchDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $branches = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(CustomerBranchResource::collection($branches), 'Customer Branches retrieved successfully');
    }

    public function store(CustomerBranchRequest $request): JsonResponse
    {
        $data = CustomerBranchData::fromRequest($request);
        $branch = $this->storeAction->execute($data);
        return $this->success(new CustomerBranchResource($branch), 'Customer Branch created successfully', 201);
    }

    public function show(CustomerBranch $customerBranch): JsonResponse
    {
        return $this->success(new CustomerBranchResource($customerBranch), 'Customer Branch details retrieved');
    }

    public function update(CustomerBranchRequest $request, CustomerBranch $customerBranch): JsonResponse
    {
        $data = CustomerBranchData::fromRequest($request);
        $branch = $this->updateAction->execute($customerBranch, $data);
        return $this->success(new CustomerBranchResource($branch), 'Customer Branch updated successfully');
    }

    public function destroy(CustomerBranch $customerBranch): JsonResponse
    {
        $this->deleteAction->execute($customerBranch);
        return $this->success(null, 'Customer Branch deleted successfully');
    }
}
