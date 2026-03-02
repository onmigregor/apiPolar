<?php

namespace Modules\RouteAssetType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RouteAssetType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'rot_code',
        'att_code',
    ];

    protected $hidden = [
        // Lista de atributos ocultos
    ];

    // Relaciones y otros métodos del modelo
}
