<?php

namespace Modules\ProductFamily\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductFamily extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cl1_code',
        'cl1_name',
    ];

    protected $hidden = [
        // Lista de atributos ocultos
    ];

    // Relaciones y otros métodos del modelo
}
