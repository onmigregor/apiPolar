<?php

namespace Modules\Discount\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Discount\Models\Discount;

class DiscountListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Discount::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('dis_code', 'like', "%{$search}%")
                  ->orWhere('dis_name', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
