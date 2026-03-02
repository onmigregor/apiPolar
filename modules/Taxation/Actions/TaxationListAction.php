<?php

namespace Modules\Taxation\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Taxation\Models\Taxation;

class TaxationListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Taxation::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('txn_code', 'like', "%{$search}%")
                  ->orWhere('txn_name', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
