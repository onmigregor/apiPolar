<?php

namespace Modules\Product\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Product\Models\Product;

class ProductListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Product::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('pro_code', 'like', "%{$search}%")
                  ->orWhere('pro_name', 'like', "%{$search}%")
                  ->orWhere('pro_short_name', 'like', "%{$search}%")
                  ->orWhere('pro_bom_code', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
