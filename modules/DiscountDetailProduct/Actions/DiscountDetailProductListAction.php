<?php

namespace Modules\DiscountDetailProduct\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\DiscountDetailProduct\Models\DiscountDetailProduct;

class DiscountDetailProductListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = DiscountDetailProduct::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('dlp_code', 'like', "%{$search}%")
                  ->orWhere('dis_code', 'like', "%{$search}%")
                  ->orWhere('did_code', 'like', "%{$search}%")
                  ->orWhere('pro_code', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
