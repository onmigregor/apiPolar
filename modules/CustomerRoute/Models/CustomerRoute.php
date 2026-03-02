<?php

namespace Modules\CustomerRoute\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerRoute extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'rot_code',
        'cus_code',
        'fre_code',
        'ctr_monday',
        'ctr_tuesday',
        'ctr_wednesday',
        'ctr_thursday',
        'ctr_friday',
    ];


    protected $hidden = [
        // Lista de atributos ocultos
    ];

    // Relaciones y otros métodos del modelo
}
