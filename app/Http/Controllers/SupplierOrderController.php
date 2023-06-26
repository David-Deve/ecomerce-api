<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SupplierOrder;
use Illuminate\Http\Request;

class SupplierOrderController extends Controller
{
    //
    public function create(Request $request){
        $supplier = new SupplierOrder();
        $supplier->product_id = $request->product_id;
        $supplier->qty = $request->qty;
        $supplier->price = $request->price;
        $supplier->total_price = $supplier->qty*$supplier->price;
        $supplier->save();
        if ($supplier){
            $product = Product::where('id',$supplier->product_id )->first();
            $product->qty = $product->qty+ $supplier->qty;
            $product->save();
            $data= [
                'message'=>'success',
                'data'=>'update success',
                'status'=>400
            ];
            return response()->json(
                $data
            );
        }
        return response()->json(
            'not complete'
        );
    }
    public function showall(){
        $supplier = SupplierOrder::with('product')->get();
        $data = [
            'message'=>'success',
            'data'=>$supplier->map(function ($report){
                return [
                    'id'=>$report->id,
                    'productid'=>$report->product_id,
                    'productname'=>$report->product->name,
                    'qty'=>$report->price,
                    'totalmount'=>$report->total_price,
                    'created_at' => $report->created_at,
                ];
            }),
            'status'=>400
        ];
        return response()->json($data);
    }
//    public function showAll()
//    {
//        $products = Product::with('productGroup')->get();
//
//        $data = [
//            'message' => 'Complete',
//            'data' => $products->map(function ($product) {
//                return [
//                    'id' => $product->id,
//                    'name' => $product->name,
//                    'price' => $product->price,
//                    'qty' => $product->qty,
//                    'group_id' => $product->group_id,
//                    'product_group_name' => $product->productGroup->name,
//                    'created_at' => $product->created_at,
//                    'updated_at' => $product->updated_at
//                ];
//            }),
//            'status' => 200
//        ];
//
//        return response()->json($data);
//    }

}
