<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'inv_id',
        'customer_name',
        'total_amount'
    ];
    public function orderProducts(){
        return $this->hasMany(OrderProduct::class);
    }

}
