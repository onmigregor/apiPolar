<?php

namespace Modules\Tax\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Tax\Models\Tax;

class TaxListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Tax::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('tax_code', 'like', "%{$search}%")
                  ->orWhere('tax_name', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
