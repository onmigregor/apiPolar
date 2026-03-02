<?php

namespace Modules\CustomerFrequency\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerFrequency extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fre_code',
        'fre_name',
        'fre_week1',
        'fre_week2',
        'fre_week3',
        'fre_week4',
        'fre_customer',
    ];

    protected $hidden = [
        // Lista de atributos ocultos
    ];

    // Relaciones y otros métodos del modelo
}
