<?php

namespace Modules\ProductClass3\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductClass3 extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_class_3';

    protected $fillable = [
        'cl3_code',
        'cl2_code',
        'cl3_name',
    ];
}
