<?php

namespace Modules\InfoType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ift_code',
        'ift_name',
        'ift_char_type',
    ];

    protected $hidden = [
        // Lista de atributos ocultos
    ];

    // Relaciones y otros métodos del modelo
}
