<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    use HasFactory;
    protected $table = 'product_groups';
    protected $fillable = [
        'id',
        'name'
    ];
    public function product(){
        return $this->hasMany(Product::class);
    }
}
