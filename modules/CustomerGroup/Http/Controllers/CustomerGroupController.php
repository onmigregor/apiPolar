<?php

namespace Modules\CustomerGroup\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\CustomerGroup\Actions\CustomerGroupDeleteAction;
use Modules\CustomerGroup\Actions\CustomerGroupListAction;
use Modules\CustomerGroup\Actions\CustomerGroupStoreAction;
use Modules\CustomerGroup\Actions\CustomerGroupUpdateAction;
use Modules\CustomerGroup\DataTransferObjects\CustomerGroupData;
use Modules\CustomerGroup\Http\Requests\CustomerGroupRequest;
use Modules\CustomerGroup\Http\Resources\CustomerGroupResource;
use Modules\CustomerGroup\Models\CustomerGroup;

class CustomerGroupController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly CustomerGroupListAction $listAction,
        private readonly CustomerGroupStoreAction $storeAction,
        private readonly CustomerGroupUpdateAction $updateAction,
        private readonly CustomerGroupDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $groups = $this->listAction->execute(
            $request->all(),
            $request->get('per_page', 15)
        );

        return $this->success(CustomerGroupResource::collection($groups), 'Customer Groups retrieved successfully');
    }

    public function store(CustomerGroupRequest $request): JsonResponse
    {
        $data = CustomerGroupData::fromRequest($request);
        $group = $this->storeAction->execute($data);

        return $this->success(new CustomerGroupResource($group), 'Customer Group created successfully', 201);
    }

    public function show(CustomerGroup $customerGroup): JsonResponse
    {
        return $this->success(new CustomerGroupResource($customerGroup), 'Customer Group details retrieved');
    }

    public function update(CustomerGroupRequest $request, CustomerGroup $customerGroup): JsonResponse
    {
        $data = CustomerGroupData::fromRequest($request);
        $group = $this->updateAction->execute($customerGroup, $data);

        return $this->success(new CustomerGroupResource($group), 'Customer Group updated successfully');
    }

    public function destroy(CustomerGroup $customerGroup): JsonResponse
    {
        $this->deleteAction->execute($customerGroup);
        return $this->success(null, 'Customer Group deleted successfully');
    }
}
