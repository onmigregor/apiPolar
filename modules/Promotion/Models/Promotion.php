<?php

namespace Modules\Promotion\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    protected $table = 'promotions';
    protected $primaryKey = 'prm_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'prm_code',
        'prm_name',
    ];
}
