<?php

namespace Modules\CustomerADC\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAdc extends Model
{
    protected $table = 'customer_adc';

    protected $fillable = [
        'fq_redi',
        'id_customer',
        'marca',
        'no_serie',
        'no_serial',
        'no_activo',
        'empresa',
        'estado',
        'tipo_activo',
    ];
}
