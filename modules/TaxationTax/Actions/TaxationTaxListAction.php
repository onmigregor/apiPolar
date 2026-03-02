<?php

namespace Modules\TaxationTax\Actions;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\TaxationTax\Models\TaxationTax;

class TaxationTaxListAction
{
    public function execute(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = TaxationTax::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('ttx_code', 'like', "%{$search}%")
                  ->orWhere('pro_code', 'like', "%{$search}%")
                  ->orWhere('txn_code', 'like', "%{$search}%")
                  ->orWhere('tax_code', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }
}
