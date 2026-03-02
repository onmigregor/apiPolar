<?php

namespace Modules\CustomerRoute\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\CustomerRoute\Models\CustomerRoute;

class CustomerRouteListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = CustomerRoute::query();
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('rot_code', 'like', "%{$search}%")
                  ->orWhere('cus_code', 'like', "%{$search}%")
                  ->orWhere('fre_code', 'like', "%{$search}%");
            });
        }
        return $query->latest()->paginate($perPage);
    }
}
