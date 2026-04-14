<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;

class CrewLogin extends Model
{
    protected $table = 'companies_crew_logins';

    protected $fillable = [
        'crw_code',
        'lgn_code',
    ];

    public function login()
    {
        return $this->belongsTo(Login::class, 'lgn_code', 'lgn_code');
    }
}
