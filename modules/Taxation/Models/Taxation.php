<?php

namespace Modules\Taxation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'txn_code',
        'txn_name',
    ];

    protected $hidden = [
        // Lista de atributos ocultos
    ];

    // Relaciones y otros métodos del modelo
}
