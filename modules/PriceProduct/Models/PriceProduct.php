<?php

namespace Modules\PriceProduct\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'prc_code',
        'pro_code',
        'unt_code',
        'ppr_date1',
        'ppr_price1_date1',
    ];

    protected $hidden = [
        // Lista de atributos ocultos
    ];

    // Relaciones y otros métodos del modelo
}
