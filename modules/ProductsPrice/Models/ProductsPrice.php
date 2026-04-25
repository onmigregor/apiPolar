<?php

namespace Modules\ProductsPrice\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsPrice extends Model
{
    protected $table = 'products_price';

    protected $fillable = [
        'lgnstreet1',
        'fecha_creacion',
        'categoria',
        'marca',
        'material',
        'descripcion',
        'empaque',
        'ud_por_cj',
        'iva',
        'precio_compra_und_sin_iva',
        'precio_compra_und_con_iva',
        'precio_compra_caja_sin_iva',
        'precio_compra_caja_con_iva',
        'precio_venta_und_sin_iva',
        'precio_venta_und_con_iva',
        'precio_venta_caja_sin_iva',
        'precio_venta_caja_con_iva',
    ];
}
