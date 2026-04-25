<?php

namespace Modules\ProductsPrice\Imports;

use Modules\ProductsPrice\Models\ProductsPrice;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class ProductsPriceImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Claves únicas: material y lgnstreet1
            if (empty($row['material']) || empty($row['lgnstreet1'])) {
                continue;
            }

            ProductsPrice::updateOrCreate(
                [
                    'material'   => (string)$row['material'],
                    'lgnstreet1' => (string)$row['lgnstreet1'],
                ],
                [
                    'fecha_creacion'            => $row['fecha_creacion'] ?? null,
                    'categoria'                 => $row['categoria'] ?? null,
                    'marca'                     => $row['marca'] ?? null,
                    'descripcion'               => $row['descripcion'] ?? null,
                    'empaque'                   => $row['empaque'] ?? null,
                    'ud_por_cj'                 => $row['ud_por_cj'] ?? null,
                    'iva'                       => $row['iva'] ?? null,
                    
                    // Precios Compra
                    'precio_compra_und_sin_iva'  => $this->parsePrice($row['precio_de_compras_fq_und_siva']),
                    'precio_compra_und_con_iva'  => $this->parsePrice($row['precio_de_compras_fq_und_civa']),
                    'precio_compra_caja_sin_iva' => $this->parsePrice($row['precio_de_compras_fq_caja_siva']),
                    'precio_compra_caja_con_iva' => $this->parsePrice($row['precio_de_compras_fq_caja_civa']),
                    
                    // Precios Venta
                    'precio_venta_und_sin_iva'   => $this->parsePrice($row['precio_de_venta_fq_und_siva']),
                    'precio_venta_und_con_iva'   => $this->parsePrice($row['precio_de_venta_fq_und_civa']),
                    'precio_venta_caja_sin_iva'  => $this->parsePrice($row['precio_de_venta_fq_caja_siva']),
                    'precio_venta_caja_con_iva'  => $this->parsePrice($row['precio_de_venta_fq_caja_civa']),
                ]
            );
        }
    }

    private function parsePrice($value)
    {
        if (is_null($value) || $value === '' || $value === '#N/A') {
            return null;
        }
        
        // Si es string, limpiar posibles caracteres (comas por puntos si vienen de excel regional)
        if (is_string($value)) {
            $value = str_replace(',', '.', $value);
        }
        
        return (float)$value;
    }
}
