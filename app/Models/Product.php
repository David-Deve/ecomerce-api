<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'price',
        'qty',
        'group_id'
    ];

    public function productGroup(){
        return $this->belongsTo(ProductGroup::class,'group_id');
    }
    public function order(){
        return $this->hasMany(Order::class);
    }
}
