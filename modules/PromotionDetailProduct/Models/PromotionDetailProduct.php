<?php

namespace Modules\PromotionDetailProduct\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromotionDetailProduct extends Model
{
    protected $table = 'promotion_detail_products';
    protected $primaryKey = 'prp_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'prp_code',
        'pdl_code',
        'prm_code',
        'pro_code',
        'unt_code',
        'prp_quantity1',
    ];
}
