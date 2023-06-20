<?php

namespace App\Http\Controllers;

use App\Models\ProductGroup;
use Illuminate\Http\Request;

class ProductGroupController extends Controller
{

    public function create (Request $request){
        $product_group = new ProductGroup();
        $product_group->name = $request->input('name');
        if(!$product_group){
            $data = [
                'message'=>'create ProductGroup Fail',
                'error'=>'something wrong'
            ];
            return response()->json(
                $data,
                401
            );
        }
        $data = [
            'message'=>'ProductGroup created',
            'error'=>'nothing',
            'product_group'=>$product_group
        ];
        $product_group->save();
        return response()->json(
            $data,
            200
        );
    }
    public function showAll(){
        $productgroup = ProductGroup::all();
        $data = [
            'message'=>'success',
            'data'=>$productgroup,
            'status'=>400
        ];
        return response()->json($data);
    }
}
