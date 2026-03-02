<?php

namespace Modules\City\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\City\Models\City;

class CityListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = City::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('cit_code', 'like', "%{$search}%")
                  ->orWhere('cit_name', 'like', "%{$search}%")
                  ->orWhere('sta_code', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
