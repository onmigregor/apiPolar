<?php

namespace Modules\Customer\Actions;

use Illuminate\Support\Facades\DB;
use Modules\CustomerRoute\Models\CustomerRoute;
use Modules\Customer\Models\Customer;
use Modules\CustomerInfoType\Models\CustomerInfoType;
use Modules\CustomerFrequency\Models\CustomerFrequency;
use Modules\CustomerCity\Models\CustomerCity;
use Modules\CustomerBranch\Models\CustomerBranch;
use Modules\CustomerGroup\Models\CustomerGroup;
use Modules\CustomerPrice\Models\CustomerPrice;
use Modules\CustomerInfo\Models\CustomerInfo;

class TruncateCustomerAction
{
    /**
     * Trunca todas las tablas relacionadas con clientes.
     *
     * 1. customer_prices       (depende de customers)
     * 2. customer_infos        (depende de customers y customer_info_types)
     * 3. customer_routes       (depende de customers + customer_frequencies)
     * 4. customers             (depende de groups, branches, cities)
     * 5. customer_info_types   (independiente)
     * 6. customer_frequencies  (independiente)
     * 7. customer_cities       (independiente)
     * 8. customer_branches     (independiente)
     * 9. customer_groups       (independiente)
     *
     * @return array Conteo de registros eliminados por tabla
     */
    public function execute(): array
    {
        // Desactivar FK checks por seguridad (en caso de que existan FKs físicas activas)
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $counts = [];

        $tables = [
            'customer_prices'      => CustomerPrice::class,
            'customer_infos'       => CustomerInfo::class,
            'customer_routes'      => CustomerRoute::class,
            'customers'            => Customer::class,
            'customer_info_types'  => CustomerInfoType::class,
            'customer_frequencies' => CustomerFrequency::class,
            'customer_cities'      => CustomerCity::class,
            'customer_branches'    => CustomerBranch::class,
            'customer_groups'      => CustomerGroup::class,
        ];

        try {
            foreach ($tables as $tableName => $modelClass) {
                // Obtener el conteo antes de truncar
                $counts[$tableName] = $modelClass::count();
                // Truncate causa un commit implícito en MySQL
                $modelClass::truncate();
            }
        } finally {
            // Reactivar FK checks siempre
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        return $counts;
    }
}
