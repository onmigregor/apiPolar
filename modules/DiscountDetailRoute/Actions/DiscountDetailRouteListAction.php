<?php

namespace Modules\DiscountDetailRoute\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\DiscountDetailRoute\Models\DiscountDetailRoute;

class DiscountDetailRouteListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = DiscountDetailRoute::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('rot_code', 'like', "%{$search}%")
                  ->orWhere('dis_code', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
