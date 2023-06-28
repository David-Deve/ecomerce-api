<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    //
    public function create(Request $request){
        $order = new Order();
        $order->customer_name = $request->input('customer_name');
        $order->total_amount = '0';
        $order->status = 'N';
        if ($order){
            $data = [
                'message'=>'created order',
                'error'=>'Nothing error',
                'order'=>$order
            ];
            $order->save();
            return response()->json(
                $data,
                200
            );
        }
        $data = [
            'message'=>'Order create fail',
            'error'=>'error',
        ];
        return response()->json(
            $data,
            401
        );
    }
    public function showOrder()
    {
        $orders = DB::table('orders')
            ->select('orders.id', 'orders.customer_name', 'orders.total_amount', 'orders.created_at', 'orders.updated_at', 'orders.status')
            ->where('orders.status', 'Y')
            ->get();

        $data = $orders->map(function ($order) {
            $products = DB::table('order_products')
                ->select('order_products.id', 'order_products.order_id', 'order_products.product_id', 'order_products.qty', 'order_products.price', 'order_products.created_at', 'order_products.updated_at', 'products.name as product_name')
                ->join('products', 'order_products.product_id', '=', 'products.id')
                ->where('order_products.order_id', $order->id)
                ->get();

            $formattedProducts = $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'product_name' => $product->product_name,
                    'order_id' => $product->order_id,
                    'product_id' => $product->product_id,
                    'qty' => $product->qty,
                    'price' => $product->price,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at
                ];
            });

            return [
                'id' => $order->id,
                'customer_name' => $order->customer_name,
                'total_amount' => $order->total_amount,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'status' => $order->status,
                'products' => $formattedProducts,
            ];
        });

        $responseData = [
            'message' => 'Orders with order status Y and their associated products',
            'data' => $data,
            'status' => 200
        ];

        return response()->json($responseData);
    }

}
