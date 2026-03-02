<?php

namespace Modules\InfoType\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\InfoType\Models\InfoType;

class InfoTypeListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = InfoType::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('ift_code', 'like', "%{$search}%")
                  ->orWhere('ift_name', 'like', "%{$search}%")
                  ->orWhere('ift_char_type', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
