<?php

namespace Modules\DynamicPlan\Models;

use Illuminate\Database\Eloquent\Model;

class PlanesDinamicosPolar extends Model
{
    protected $table = 'polar_dynamic_plans';

    protected $fillable = [
        'cod_fq',
        'meta_cerveceria',
        'meta_maltin',
        'meta_sangria',
        'meta_pcv',
        'meta_apc',
        'meta_pomar',
        'metas_pg',
    ];
}
