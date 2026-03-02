<?php

namespace Modules\CustomerPrice\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\CustomerPrice\Models\CustomerPrice;

class CustomerPriceListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = CustomerPrice::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('rot_code', 'like', "%{$search}%")
                  ->orWhere('cus_code', 'like', "%{$search}%")
                  ->orWhere('prc_code', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
