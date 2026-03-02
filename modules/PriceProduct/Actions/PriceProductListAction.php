<?php

namespace Modules\PriceProduct\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\PriceProduct\Models\PriceProduct;

class PriceProductListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = PriceProduct::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('prc_code', 'like', "%{$search}%")
                  ->orWhere('pro_code', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
