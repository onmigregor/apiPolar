<?php

namespace Modules\CustomerInfo\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\CustomerInfo\Models\CustomerInfo;

class CustomerInfoListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = CustomerInfo::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('cus_code', 'like', "%{$search}%")
                  ->orWhere('ift_code', 'like', "%{$search}%")
                  ->orWhere('ctn_char_value', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
