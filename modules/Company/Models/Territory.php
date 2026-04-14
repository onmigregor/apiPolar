<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;

class Territory extends Model
{
    protected $table = 'companies_territories';
    protected $primaryKey = 'try_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'try_code',
        'brc_code',
        'lgn_code',
        'try_name',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'brc_code', 'brc_code');
    }

    public function login()
    {
        return $this->belongsTo(Login::class, 'lgn_code', 'lgn_code');
    }
}
