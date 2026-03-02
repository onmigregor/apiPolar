<?php

namespace Modules\DiscountDetail\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dis_code',
        'did_code',
        'did_name',
        'rot_code_customer',
        'cus_code',
        'did_since',
        'did_until',
    ];

    protected $hidden = [
        // Lista de atributos ocultos
    ];

    // Relaciones y otros métodos del modelo
}
