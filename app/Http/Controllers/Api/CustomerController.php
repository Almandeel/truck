<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\OrderItem;
use App\OrderTender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    //

    public function profile() {
        return response()->json(auth('api')->user());
    }

    public function orders() {
        $orders = Order::with('items')->where('user_add_id', auth('api')->user()->id)->get()->map(function($order) {
            return [
                'from'          => $order->from,
                'to'            => $order->to,
                'order_type'    => $order->type,
                'shipping_date' => $order->shipping_date,
                'savior_name'   => $order->savior_name,
                'savior_phone'  => $order->savior_phone,
                'status'        => __('global.' . Order::status[$order->status])
            ];
        });

        return response()->json($orders); 
    }

    public function order(Request $request) {
        $request->validate([
            'name'              => 'required | string | max:45',  
            'phone'             => 'required | string | max:255',
            'from'              => 'required | string',
            'to'                => 'required | string',
            'order_type'        => 'required | string',
        ]);
        
        $order = Order::create([
            'type'          => $request->order_type,
            'name'          => $request->name,
            'phone'         => $request->phone,
            'from'          => $request->from,
            'to'            => $request->to,
            'shipping_date' => $request->shipping_date,
            'savior_name'   => $request->savior_name,
            'savior_phone'  => $request->savior_phone,
            'user_add_id'   => auth('api')->user()->id,
        ]);

        for ($index=0; $index < count($request->quantity); $index++) { 
            $order_items = OrderItem::create([
                'order_id'  => $order->id,
                'type'      => $request->item_type[$index],
                'quantity'  => $request->quantity[$index],
                'weight'    => $request->weight[$index],
            ]);
        }

        return response()->json([
            'order_number' => $order->id,
        ]);
    }

    public function showOrder($order_id) {
        $order = Order::with('items')->where('id', $order_id)->where('user_add_id', auth('api')->user()->id)->first();
        $tenders = OrderTender::where('order_id', $order_id)->where('status', 0)->get()->map(function($tender) {
            return [
                'price'         => $tender->price,
                'duration'      => $tender->duration,
                'company_id'    => $tender->company_id,
            ];
        });
        return response()->json([
            'order'     => $order,
            'tenders'   => $tenders
        ]);
    }

    public function updateOrder(Request $request) {
        $order = Order::find($request->order_id);

        $tender = OrderTender::create([
            'order_id'      => $order->id,
            'company_id'    => auth('api')->user()->company_id,
            'price'         => $request->price,
            'duration'      => $request->duration,
        ]);

        return $this->showOrder($order->id);
    }

}