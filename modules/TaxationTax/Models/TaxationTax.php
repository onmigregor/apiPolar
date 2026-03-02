<?php

namespace Modules\TaxationTax\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxationTax extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ttx_code',
        'txn_code',
        'tax_code',
        'ttx_date1',
        'pro_code',
        'ttx_percent_date1',
        'unt_code',
    ];

    protected $hidden = [
        // Lista de atributos ocultos
    ];

    // Relaciones y otros métodos del modelo
}
