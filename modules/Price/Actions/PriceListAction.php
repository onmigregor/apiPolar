<?php

namespace Modules\Price\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Price\Models\Price;

class PriceListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Price::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('prc_code', 'like', "%{$search}%")
                  ->orWhere('prc_name', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
