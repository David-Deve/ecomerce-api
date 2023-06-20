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

    public function productgroup(){
        return $this->belongsTo(ProductGroup::class);
    }
    public function order(){
        return $this->hasMany(Order::class);
    }
}
