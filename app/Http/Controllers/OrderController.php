<?php

namespace App\Http\Controllers;

use App\Unit;
use App\Zone;
use App\Order;
use App\Driver;
use App\Market;
use App\Vehicle;
use App\OrderItem;
use App\WarehouseOrder;
use App\WarehouseUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::all();
        return view('dashboard.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units      = Unit::all();
        $zones      = Zone::all();
        $vehicles   = Vehicle::all();
        return view('dashboard.orders.create', compact('units', 'zones', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            'status'        => Order::ORDER_ACCEPTED,
            'accepted_at'   => date('Y-m-d H:I'),
            'user_add_id'   => auth()->user()->id,
            'user_accepted_id' => auth()->user()->id,
        ]);

        for ($index=0; $index < count($request->quantity); $index++) { 
            $order_items = OrderItem::create([
                'order_id'  => $order->id,
                'type'      => $request->item_type[$index],
                'quantity'  => $request->quantity[$index],
                'weight'    => $request->weight[$index],
            ]);
        }

        return back()->with('success', 'تمت العملية بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('dashboard.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $units      = Unit::all();
        $zones      = Zone::all();
        $vehicles   = Vehicle::all();
        return view('dashboard.orders.edit', compact('units', 'zones', 'vehicles', 'order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if($request->type == 'accepted') {
            $order->update([
                'status' => Order::ORDER_ACCEPTED,
                'user_accepted_id' => auth()->user()->id,
                'accepted_at' => date('Y-m-d H:I'),
            ]);
            return back()->with('success', 'تمت العملية بنجاح');
        }else
        {
            $request->validate([
                'name'              => 'required | string | max:45',  
                'phone'             => 'required | string | max:255',
                'from'              => 'required | string',
                'to'                => 'required | string',
                'order_type'        => 'required | string',
            ]);
    
            $order->update([
                'type'          => $request->order_type,
                'name'          => $request->name,
                'phone'         => $request->phone,
                'from'          => $request->from,
                'to'            => $request->to,
            ]);

            foreach ($order->items as $item) {
                $item->delete();
            }
    
            for ($index=0; $index < count($request->quantity); $index++) {
                $order_items = OrderItem::create([
                    'order_id'  => $order->id,
                    'type'      => $request->item_type[$index],
                    'quantity'  => $request->quantity[$index],
                    'weight'    => $request->weight[$index],
                ]);
            }
            return redirect()->route('orders.show', $order->id)->with('success', 'تمت العملية بنجاح');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->update([
            'status' => Order::$status_cancel
        ]);

        return back();
    }


    public function orders(Request $request) {
        $orders = Order::where('market_id', $request->market)->where('status', 0)->get();
        return response()->json($orders);
    }


    public function marketOrdersStore(Request $request) {
        $request->validate([
            'phone'             => 'required | string | max:45',  
            'address'           => 'required | string | max:255',
            'amount'            => 'required' ,
            'receiver_address'  => 'required | string | max:45', 
            'receiver_phone'    => 'required | string | max:45', 
        ]);

        $request_data = $request->except('_token');
        $request_data['delivery_amount'] = $request->from == $request->to ? 200 : 250;

        $request_data['market_id'] = auth()->user()->market_id;

        $order = Order::create($request_data);

        // $warehouse = WarehouseOrder::create([
        //     'order_id' => $order->id,
        //     'user_id' => auth()->user()->id,
        //     'warehouse_id' => $request->warehouse_id,
        // ]);

        $order->update([
            'order_number' => date('Ym') . $order->id
        ]);

        return back()->with('success', 'تمت العملية بنجاح');
    }
}
