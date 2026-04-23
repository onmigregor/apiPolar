<?php
namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerSegment extends Model
{
    protected $table = 'customer_segments';
    
    protected $fillable = [
        'tp3_code',
        'tp3_name'
    ];
}
