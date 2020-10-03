<?php

namespace App\Http\Controllers\Api;


use App\Unit;
use App\Zone;
use App\Order;
use App\Vehicle;
use App\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['orders']]);
    }

    public function units() {
        $units = Unit::all();
        return response()->json($units);
    }

    public function zones() {
        $zones = Zone::all();
        return response()->json($zones);
    }

    public function vehicles() {
        $vehicles = Vehicle::all();
        return response()->json($vehicles);
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
            'user_add_id'   => $request->user_id,
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

    public function orders() {
        $orders = Order::where('user_add_id', auth('api')->user()->id)->get()->map(function ($order) {
            return [
                'id'            => $order->id,
                'name'          => $order->name,
                'phone'         => $order->phone,
                'from'          => $order->from,
                'to'            => $order->to,
                'type_order'    => $order->type,
                'savior_name'   => $order->savior_name,
                'savior_phone'  => $order->savior_phone,
                'shipping_date' => $order->shipping_date,
                'status'        => Order::status[$order->status],
            ];
        });
        return response()->json([
            'orders' => $orders,
        ]);
    }

    public function showOrder($order_id, $user_id) {
        $order = Order::with('items')->where('id', $order_id)->where('user_add_id', $user_id)->get();
        return response()->json([
            'order' => $order,
        ]);
    }
}
