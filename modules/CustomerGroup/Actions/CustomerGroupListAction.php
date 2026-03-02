<?php

namespace Modules\CustomerGroup\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\CustomerGroup\Models\CustomerGroup;

class CustomerGroupListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = CustomerGroup::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('tp1_code', 'like', "%{$search}%")
                  ->orWhere('tp1_name', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
