<?php

namespace Modules\Route\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Route\Models\Route;

class RouteListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Route::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('rot_code', 'like', "%{$search}%")
                  ->orWhere('rot_name', 'like', "%{$search}%")
                  ->orWhere('lgn_code', 'like', "%{$search}%")
                  ->orWhere('try_code', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
