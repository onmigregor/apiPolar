<?php

namespace Modules\RouteGeneral\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\RouteGeneral\Models\RouteGeneral;

class RouteGeneralListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = RouteGeneral::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('rot_code', 'like', "%{$search}%")
                  ->orWhere('jrn_code', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
