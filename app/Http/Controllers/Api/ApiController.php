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
        
        $order_items = OrderItem::create([
            'order_id'  => $order->id,
            'type'      => $request->item_type,
            'quantity'  => $request->quantity,
            'weight'    => $request->weight,
            'unit_id'    => $request->unit,
        ]);

        return response()->json([
            'order_number' => $order->id,
        ]);
    }

    public function orders($user_id) {
        $orders = Order::where('user_add_id', $user_id)->get();
        return response()->json([
            'orders' => $orders,
        ]);
    }

    public function showOrder($order_id, $user_id) {
        $order = Order::where('id', $order_id)->where('user_add_id', $user_id)->get();
        return response()->json([
            'order' => $order,
        ]);
    }
}
