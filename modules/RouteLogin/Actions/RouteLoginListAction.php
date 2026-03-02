<?php

namespace Modules\RouteLogin\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\RouteLogin\Models\RouteLogin;

class RouteLoginListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = RouteLogin::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('rot_code', 'like', "%{$search}%")
                  ->orWhere('lgn_code', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
