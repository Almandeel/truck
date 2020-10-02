<?php

namespace App\Http\Controllers;

use App\Unit;
use App\Zone;
use App\Order;
use App\Vehicle;
use App\OrderItem;
use App\OrderTender;
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
        if(auth()->user()->hasRole('superadmin')) {
            // where user is  super admin or customer services
            if($request->type == 'active') {
                $orders = Order::whereIn('status', [Order::ORDER_IN_SHIPPING, Order::ORDER_IN_ROAD])->get();
            }

            if($request->type == 'deactive') {
                $orders = Order::whereIn('status', [Order::ORDER_DEFAULT, Order::ORDER_ACCEPTED])->get();
            }

            if($request->type == 'done') {
                $orders = Order::whereIn('status', [Order::ORDER_DONE, Order::ORDER_CANCEL])->get();
            }
        }

        if(auth()->user()->hasRole('customer')) {
            // where user is customer
            if($request->type == 'done') {
                $orders = Order::whereIn('status', [Order::ORDER_DONE, Order::ORDER_CANCEL])->where('user_add_id', auth()->user()->id)->get();
            }
            if($request->type == 'active') {
                $orders = Order::whereNotIn('status', [Order::ORDER_DONE, Order::ORDER_CANCEL])->where('user_add_id', auth()->user()->id)->get();
            }
        }

        if(auth()->user()->hasRole('company')) {
            // where user in company
            if($request->type == 'deactive') {
                $orders = Order::where('status', Order::ORDER_ACCEPTED)->where('company_id', null)->get();
            }

            if($request->type == 'done') {
                $orders = Order::whereIn('status', [Order::ORDER_DONE, Order::ORDER_CANCEL])->where('company_id', auth()->user()->company_id)->get();
            }

            if($request->type == 'active') {
                $orders = Order::whereIn('status', [Order::ORDER_IN_SHIPPING, Order::ORDER_IN_ROAD])->where('company_id', auth()->user()->company_id)->get();
            }
            
        }

        if($request->type == '') {
            $orders = Order::whereIn('status', [Order::ORDER_IN_SHIPPING, Order::ORDER_IN_ROAD])->get();
        }

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
            'shipping_date' => $request->shipping_date,
            'savior_name'   => $request->savior_name,
            'savior_phone'  => $request->savior_phone,
            'user_add_id'   => auth()->user()->id,
        ]);

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $tenders = [];
        if(auth()->user()->company_id) {
            $tenders = OrderTender::pluck('company_id')->toArray();
        }
        return view('dashboard.orders.show', compact('order', 'tenders'));
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
        }

        if($request->type == 'tender'){
            $tender = OrderTender::create([
                'order_id'      => $order->id,
                'company_id'    => auth()->user()->company_id,
                'price'         => $request->price,
                'duration'      => $request->duration,
            ]);

            return back()->with('success', 'تمت العملية بنجاح');
        }

        if($request->type == 'received'){
            $order->update([
                'status'        => Order::ORDER_IN_SHIPPING,
                'company_id'    => $request->company_id,
                'received_at'   => date('Y-m-d H:I'),
            ]);
            
            return back()->with('success', 'تمت العملية بنجاح');
        }

        if($request->type == 'shipping'){
            $order->update([
                'status'        => Order::ORDER_IN_ROAD,
            ]);
            return back()->with('success', 'تمت العملية بنجاح');
        }

        if($request->type == 'road'){
            $order->update([
                'status'        => Order::ORDER_DONE,
                'delivered_at' => date('Y-m-d H:I'),
            ]);
            return back()->with('success', 'تمت العملية بنجاح');
        }

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
            'savior_name'   => $request->savior_name,
            'savior_phone'  => $request->savior_phone,
            'shipping_date' => $request->shipping_date,
        ]);

        foreach ($order->items as $item) {
            $item->delete();
        }

        for($index=0; $index < count($request->quantity); $index++) {
            $order_items = OrderItem::create([
                'order_id'  => $order->id,
                'type'      => $request->item_type[$index],
                'quantity'  => $request->quantity[$index],
                'weight'    => $request->weight[$index],
            ]);
        }
    
        return redirect()->route('orders.show', $order->id)->with('success', 'تمت العملية بنجاح');
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
}
