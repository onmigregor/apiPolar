<?php

namespace Modules\CustomerBranch\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\CustomerBranch\Models\CustomerBranch;

class CustomerBranchListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = CustomerBranch::query();
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('tp2_code', 'like', "%{$search}%")
                  ->orWhere('tp2_name', 'like', "%{$search}%");
            });
        }
        return $query->latest()->paginate($perPage);
    }
}
