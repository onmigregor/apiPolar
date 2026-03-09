<?php

namespace Modules\ProductCategory\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\ProductCategory\Models\ProductCategory;

class ProductCategoryListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = ProductCategory::query();
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('cl2_code', 'like', "%{$search}%")
                  ->orWhere('cl2_name', 'like', "%{$search}%")
                  ->orWhere('cl1_code', 'like', "%{$search}%");
            });
        }
        return $query->latest()->paginate($perPage);
    }
}
