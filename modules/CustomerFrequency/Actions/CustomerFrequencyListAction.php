<?php

namespace Modules\CustomerFrequency\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\CustomerFrequency\Models\CustomerFrequency;

class CustomerFrequencyListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = CustomerFrequency::query();
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('fre_code', 'like', "%{$search}%")
                  ->orWhere('fre_name', 'like', "%{$search}%");
            });
        }
        return $query->latest()->paginate($perPage);
    }
}
