<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;

class LoginBranch extends Model
{
    protected $table = 'companies_login_branches';

    protected $fillable = [
        'lgn_code',
        'brc_code',
    ];

    public function login()
    {
        return $this->belongsTo(Login::class, 'lgn_code', 'lgn_code');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'brc_code', 'brc_code');
    }
}
