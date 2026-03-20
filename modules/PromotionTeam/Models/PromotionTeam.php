<?php

namespace Modules\PromotionTeam\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromotionTeam extends Model
{
    protected $table = 'promotion_teams';

    protected $fillable = [
        'tea_code',
        'prm_code',
    ];
}
