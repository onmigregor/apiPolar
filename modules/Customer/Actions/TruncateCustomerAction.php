<?php

namespace Modules\Customer\Actions;

use Illuminate\Support\Facades\DB;
use Modules\CustomerRoute\Models\CustomerRoute;
use Modules\Customer\Models\Customer;
use Modules\InfoType\Models\InfoType;
use Modules\CustomerFrequency\Models\CustomerFrequency;
use Modules\CustomerRegion\Models\CustomerRegion;
use Modules\CustomerBranch\Models\CustomerBranch;
use Modules\CustomerGroup\Models\CustomerGroup;

class TruncateCustomerAction
{
    /**
     * Trunca todas las tablas relacionadas con clientes.
     *
     * El orden es estricto e inverso al de carga (dependencias primero):
     * 1. customer_routes       (depende de customers + customer_frequencies)
     * 2. customers             (depende de customer_groups, customer_branches, customer_regions)
     * 3. info_types            (independiente en este nivel)
     * 4. customer_frequencies  (independiente)
     * 5. customer_regions      (independiente)
     * 6. customer_branches     (independiente)
     * 7. customer_groups       (independiente)
     *
     * @return array Conteo de registros eliminados por tabla
     */
    public function execute(): array
    {
        // Desactivar FK checks por seguridad (en caso de que existan FKs físicas activas)
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $counts = [];

        $tables = [
            'customer_routes'      => CustomerRoute::class,
            'customers'            => Customer::class,
            'info_types'           => InfoType::class,
            'customer_frequencies' => CustomerFrequency::class,
            'customer_regions'     => CustomerRegion::class,
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
