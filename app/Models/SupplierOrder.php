<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierOrder extends Model
{
    use HasFactory;
    protected $table = 'supplier_orders';
    protected $fillable = [
        'id',
        'product_id',
        'qty',
        'price',
        'total_price'
    ];
}
