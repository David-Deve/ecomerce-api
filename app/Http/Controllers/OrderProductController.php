<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderProductController extends Controller
{
    //
    public function create(Request $request, $order_id){
        $order = Order::findOrFail($order_id);
        $validateData = $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.qty' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
        ]);
        DB::beginTransaction();
        try {
            if ($order->status == 'N'){
                foreach ($validateData['products'] as $productData ){
                    $orderProduct = new OrderProduct();
                    $orderProduct->order_id = $order->id;
                    $orderProduct->product_id = $productData['product_id'];
                    $orderProduct->qty = $productData['qty'];
                    $orderProduct->price = $productData['price'];
                    $orderProduct->save();

                    $product = Product::findOrFail($productData['product_id']);
                    $product->qty -= $productData['qty'];
                    $product->save();
                }
                $totalPrice = $order->orderProducts()->sum(DB::raw('qty * price'));
                $order->total_amount = $totalPrice;
                $order->status= 'Y';
                $order->save();

                DB::commit();
                $data=[
                    'message'=>'order successfully',
                    'error'=>'Nothing',
                    'order_product'=>$validateData['products'],
                ];
                return response()->json(
                    $data,
                    200
                );
            }else{
                return response()->json(['message' => 'Failed to create order products', 'error' => 'Cart has been submit'], 500);
            }
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message' => 'Failed to create order products', 'error' => $e->getMessage()], 500);
        }
    }
}
