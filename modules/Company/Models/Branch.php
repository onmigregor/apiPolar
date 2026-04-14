<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'companies_branches';
    protected $primaryKey = 'brc_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'brc_code',
        'brc_name',
        'brc_general_header1',
        'reg_code',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'reg_code', 'reg_code');
    }
}
