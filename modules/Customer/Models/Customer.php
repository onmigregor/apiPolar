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
        'cus_tax_id1',
        'cus_tax_id2',
        'cus_tax_id3',
        'cus_phone',
        'cus_street1',
        'cus_street2',
        'cus_street3',
        'cus_latitude',
        'cus_longitude',
        'cus_contact_person',
        'cus_administrator',
        'cit_code',
        'txn_code',
        'met_code1',
        'tp1_code',
        'tp2_code',
        'tp3_code',
    ];


    protected $hidden = [
        // Lista de atributos ocultos
    ];
}
