<?php

namespace Modules\Product\Actions;

use Illuminate\Support\Facades\DB;
use Modules\ProductUnit\Models\ProductUnit;
use Modules\Product\Models\Product;
use Modules\ProductCategory\Models\ProductCategory;
use Modules\ProductFamily\Models\ProductFamily;
use Modules\Unit\Models\Unit;

class TruncateProductAction
{
    /**
     * Trunca todas las tablas relacionadas con productos.
     *
     * El orden es inverso al de carga (dependencias primero):
     * 1. product_units  (depende de products + units)
     * 2. products       (depende de product_categories + units)
     * 3. product_categories (depende de product_families)
     * 4. product_families   (independiente)
     * 5. units              (independiente)
     *
     * @return array Conteo de registros eliminados por tabla
     */
    public function execute(): array
    {
        // Desactivar FK checks por seguridad (en caso de que existan FKs)
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $counts = [];

        $tables = [
            'product_units'      => ProductUnit::class,
            'products'           => Product::class,
            'product_categories' => ProductCategory::class,
            'product_families'   => ProductFamily::class,
            'units'              => Unit::class,
        ];

        try {
            foreach ($tables as $tableName => $modelClass) {
                // Obtener el conteo antes de truncar
                $counts[$tableName] = $modelClass::count();
                // Truncate es una sentencia DDL que causa un commit implícito en MySQL,
                // por lo que no puede ir dentro de un DB::transaction() de Laravel de forma segura.
                $modelClass::truncate();
            }
        } finally {
            // Reactivar FK checks siempre, incluso si falla un truncate
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        return $counts;
    }
}
