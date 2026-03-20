<?php

namespace Modules\PromotionDetail\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromotionDetail extends Model
{
    protected $table = 'promotion_details';
    protected $primaryKey = 'pdl_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pdl_code',
        'prm_code',
        'pdl_name',
        'pdl_since',
        'pdl_until',
        'cus_code',
    ];
}
