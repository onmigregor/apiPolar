<?php

namespace Modules\ProductUnit\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\ProductUnit\Models\ProductUnit;

class ProductUnitListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = ProductUnit::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('pro_code', 'like', "%{$search}%")
                  ->orWhere('unt_code', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
