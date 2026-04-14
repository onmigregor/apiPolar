<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table = 'companies_logins';
    protected $primaryKey = 'lgn_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'lgn_code',
        'lgn_name',
        'brc_code',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'brc_code', 'brc_code');
    }
}
