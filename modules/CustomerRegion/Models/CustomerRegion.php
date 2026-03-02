<?php

namespace Modules\CustomerRegion\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerRegion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cit_code',
        'cit_name',
        'sta_code',
    ];

    protected $hidden = [
        // Lista de atributos ocultos
    ];

    // Relaciones y otros métodos del modelo
}
