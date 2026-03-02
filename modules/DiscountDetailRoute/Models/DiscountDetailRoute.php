<?php

namespace Modules\DiscountDetailRoute\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountDetailRoute extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'rot_code',
        'dis_code',
    ];

    protected $hidden = [
        // Lista de atributos ocultos
    ];

    // Relaciones y otros métodos del modelo
}
