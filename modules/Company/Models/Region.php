<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'companies_regions';
    protected $primaryKey = 'reg_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'reg_code',
        'reg_name',
    ];
}
