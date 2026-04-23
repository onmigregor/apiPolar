<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pro_code',
        'pro_name',
        'pro_short_name',
        'pro_barcode',
        'pro_organization',
        'unt_code',
        'pro_bom_code',
        'cl2_code',
        'cl3_code',
        'cl4_code',
        'pro_return_allowed',
        'pro_damage_returns_allowed',
        'pro_available_for_sale',
        'pro_customer_inventory_allowed',
        'pro_created_on',
        'pro_modified_on',
        'pro_weight',
        'pro_unit_code_bom',
    ];

    protected $hidden = [
        // Lista de atributos ocultos
    ];

    // Relaciones y otros métodos del modelo
}
