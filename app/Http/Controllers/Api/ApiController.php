<?php

namespace App\Http\Controllers\Api;

use App\Unit;
use App\Zone;
use App\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
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
            'user_add_id'   => $request->user_id,
        ]);
        
        $order_items = OrderItem::create([
            'order_id'  => $order->id,
            'type'      => $request->item_type,
            'quantity'  => $request->quantity,
            'weight'    => $request->weight,
            'unit_id'    => $request->unit,
        ]);
    }
}
