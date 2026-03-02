<?php

namespace Modules\Product\Actions;

use Illuminate\Support\Facades\DB;
use Modules\Product\Mappers\ProductMapper;
use Modules\ProductUnit\Mappers\ProductUnitMapper;

use Modules\Product\Models\Product;
use Modules\ProductUnit\Models\ProductUnit;

class MasterProductAction
{
    /**
     * Ejecuta la carga masiva de datos maestros de producto.
     * Recibe un ARRAY de bloques, cada uno con secciones nombradas.
     * Todo se ejecuta dentro de una sola transacción para mantener integridad.
     *
     * @param array $items Array de bloques de carga (1 a N productos)
     * @return array Resultados de cada bloque procesado
     */
    public function execute(array $items): array
    {
        return DB::transaction(function () use ($items) {
            $results = [];

            foreach ($items as $index => $payload) {
                $record = [];

                // 1. Producto → Product
                if (!empty($payload['Producto'])) {
                    $mapped = ProductMapper::transform($payload['Producto']);
                    $record['Producto'] = Product::create($mapped);
                }

                // 2. unidadProducto → ProductUnit
                if (!empty($payload['unidadProducto'])) {
                    $mapped = ProductUnitMapper::transform($payload['unidadProducto']);
                    $record['unidadProducto'] = ProductUnit::create($mapped);
                }

                $results[] = $record;
            }

            return $results;
        });
    }
}
