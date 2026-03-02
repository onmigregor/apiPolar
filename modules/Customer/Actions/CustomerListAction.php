<?php

namespace Modules\Customer\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Customer\Models\Customer;

class CustomerListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Customer::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('cus_code', 'like', "%{$search}%")
                  ->orWhere('cus_name', 'like', "%{$search}%")
                  ->orWhere('cus_business_name', 'like', "%{$search}%")
                  ->orWhere('cus_tax_id1', 'like', "%{$search}%")
                  ->orWhere('cus_email', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
