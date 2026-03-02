<?php

namespace Modules\RouteGeneral\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RouteGeneral extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'rot_code',
        'gnl_date',
        'gnl_month_working_days',
        'gnl_days_up_to_date',
        'gnl_next_working_day',
        'jrn_code',
        'gnl_status',
        'gnl_status_date',
    ];

    protected $hidden = [
        // Lista de atributos ocultos
    ];

    // Relaciones y otros métodos del modelo
}
