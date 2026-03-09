<?php

namespace Modules\ProductFamily\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\ProductFamily\Models\ProductFamily;

class ProductFamilyListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = ProductFamily::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('cl1_code', 'like', "%{$search}%")
                  ->orWhere('cl1_name', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
