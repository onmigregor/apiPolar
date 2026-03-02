<?php

namespace Modules\Unit\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Unit\Models\Unit;

class UnitListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Unit::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('unt_code', 'like', "%{$search}%")
                  ->orWhere('unt_name', 'like', "%{$search}%")
                  ->orWhere('unt_nick', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
