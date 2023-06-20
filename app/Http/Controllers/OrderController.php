<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

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
}
