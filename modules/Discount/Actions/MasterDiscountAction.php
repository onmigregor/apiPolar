<?php

namespace Modules\Discount\Actions;

use Illuminate\Support\Facades\DB;
use Modules\Discount\Mappers\DiscountMapper;
use Modules\DiscountDetail\Mappers\DiscountDetailMapper;
use Modules\DiscountDetailProduct\Mappers\DiscountDetailProductMapper;
use Modules\DiscountDetailRoute\Mappers\DiscountDetailRouteMapper;

use Modules\Discount\Models\Discount;
use Modules\DiscountDetail\Models\DiscountDetail;
use Modules\DiscountDetailProduct\Models\DiscountDetailProduct;
use Modules\DiscountDetailRoute\Models\DiscountDetailRoute;

class MasterDiscountAction
{
    /**
     * Ejecuta la carga masiva de datos maestros de descuento.
     * Recibe un ARRAY de bloques, cada uno con secciones nombradas.
     * Todo se ejecuta dentro de una sola transacción para mantener integridad.
     *
     * @param array $items Array de bloques de carga (1 a N descuentos)
     * @return array Resultados de cada bloque procesado
     */
    public function execute(array $items): array
    {
        return DB::transaction(function () use ($items) {
            $results = [];

            foreach ($items as $index => $payload) {
                $record = [];

                // 1. Descuento → Discount
                if (!empty($payload['Descuento'])) {
                    $mapped = DiscountMapper::transform($payload['Descuento']);
                    $record['Descuento'] = Discount::create($mapped);
                }

                // 2. detalleDescuento → DiscountDetail
                if (!empty($payload['detalleDescuento'])) {
                    $mapped = DiscountDetailMapper::transform($payload['detalleDescuento']);
                    $record['detalleDescuento'] = DiscountDetail::create($mapped);
                }

                // 3. productoDescuento → DiscountDetailProduct
                if (!empty($payload['productoDescuento'])) {
                    $mapped = DiscountDetailProductMapper::transform($payload['productoDescuento']);
                    $record['productoDescuento'] = DiscountDetailProduct::create($mapped);
                }

                // 4. rutaDescuento → DiscountDetailRoute
                if (!empty($payload['rutaDescuento'])) {
                    $mapped = DiscountDetailRouteMapper::transform($payload['rutaDescuento']);
                    $record['rutaDescuento'] = DiscountDetailRoute::create($mapped);
                }

                $results[] = $record;
            }

            return $results;
        });
    }
}
