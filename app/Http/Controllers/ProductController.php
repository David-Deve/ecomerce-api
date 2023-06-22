<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGroup;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function showAll()
    {
        $products = Product::with('productGroup')->get();

        $data = [
            'message' => 'Complete',
            'data' => $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'qty' => $product->qty,
                    'group_id' => $product->group_id,
                    'product_group_name' => $product->productGroup->name,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at
                ];
            }),
            'status' => 200
        ];

        return response()->json($data);
    }
    public function delete($id){
        $product = Product::find($id);
        $product->delete();
        $data = [
            'message'=>'success',
            'error'=>'Deleted',
            'status'=>400
        ];
        return response()->json(
            $data
        );
    }
    public function update(Request $request, $id){
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->group_id = $request->group_id;
        $product->save();
        $data = [
            'message'=>'success',
            'error'=>'save complete',
            'status'=>400
        ];
        return response()->json(
            $data
        );
    }
    public function create(Request $request){
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->group_id = $request->group_id;
        $product->save();
        $data = [
            'message'=>'complete',
            'product'=>$product,
            'status'=>4001
        ];
        return response()->json(
            $data
        );
    }


}
