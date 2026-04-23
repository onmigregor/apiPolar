<?php
namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;

class ProductClass4 extends Model
{
    protected $table = 'product_class4s';
    
    protected $fillable = [
        'cl4_code',
        'cl4_name'
    ];
}
