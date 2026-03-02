<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cus_code',
        'cus_name',
        'cus_business_name',
        'cus_duns',
        'cus_comm_id',
        'tp1_code',
        'tp2_code',
        'cit_code',
        'txn_code',
        'cus_phone',
        'cus_fax',
        'cus_street1',
        'cus_street2',
        'cus_street3',
        'cus_tax_id1',
        'brc_code',
        'cus_latitude',
        'cus_longitude',
        'prc_code_for_sale',
        'prc_code_for_return',
        'cus_contact_person',
        'cus_email',
    ];


    protected $hidden = [
        // Lista de atributos ocultos
    ];

    // Relaciones y otros métodos del modelo
}
