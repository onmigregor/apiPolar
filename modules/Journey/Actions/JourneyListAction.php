<?php

namespace Modules\Journey\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Journey\Models\Journey;

class JourneyListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Journey::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('jrn_code', 'like', "%{$search}%")
                  ->orWhere('rot_code', 'like', "%{$search}%")
                  ->orWhere('jrn_dummy', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
