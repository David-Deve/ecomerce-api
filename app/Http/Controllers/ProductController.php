<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function showAll(){
        $product = Product::all();
        $data = [
            'message' => 'complete',
            'data'=>$product,
            'status'=>400
        ];
        return response()->json($data);
    }
}
