<?php

namespace Modules\DiscountDetail\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\DiscountDetail\Models\DiscountDetail;

class DiscountDetailListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = DiscountDetail::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('did_code', 'like', "%{$search}%")
                  ->orWhere('dis_code', 'like', "%{$search}%")
                  ->orWhere('did_name', 'like', "%{$search}%")
                  ->orWhere('cus_code', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
