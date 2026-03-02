<?php

namespace Modules\CustomerInfo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cus_code',
        'ift_code',
        'ctn_char_value',
    ];

    protected $hidden = [
        // Lista de atributos ocultos
    ];

    // Relaciones y otros métodos del modelo
}
