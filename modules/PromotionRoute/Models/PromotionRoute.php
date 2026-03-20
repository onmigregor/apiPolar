<?php

namespace Modules\PromotionRoute\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromotionRoute extends Model
{
    protected $table = 'promotion_routes';

    protected $fillable = [
        'rot_code',
        'prm_code',
    ];
}
