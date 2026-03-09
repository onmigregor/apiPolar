<?php

namespace Modules\ProductCategory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cl2_code',
        'cl1_code',
        'cl2_name',
    ];

    protected $hidden = [];
}
