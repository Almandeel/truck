<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function profile() {
        return response()->json(auth('api')->user());
    }

    public function newOrders() {
        $orders = Order::where('status', Order::ORDER_ACCEPTED)->get()->map(function($order) {
            return [
                'id'            => $order->id,
                'order_type'    => $order->type,
                'from'          => $order->from,
                'to'            => $order->to,
                'status'        => __('global.' . Order::status[$order->status])
            ];
        });
    }

    public function oldOrders() {
        $orders = Order::with('items')->where('company_id', auth('api')->user()->company_id)->get()->map(function($order) {
            return [
                'id'            => $order->id,
                'order_type'    => $order->type,
                'from'          => $order->from,
                'to'            => $order->to,
                'status'        => __('global.' . Order::status[$order->status])
            ];
        });


        return response()->json([$orders]); 
    }

    public function showOrder($order_id) {
        $order = Order::with('items')->where('id', $order_id)->where('company_id', auth('api')->user()->company_id)->first()->map(function ($order) {
            return [
                'id'            => $order->id,
                'from'          => $order->from,
                'to'            => $order->to,
                'order_type'    => $order->type,
                'shipping_date' => $order->shipping_date,
                'savior_name'   => $order->savior_name,
                'savior_phone'  => $order->savior_phone,
                'status'        => __('global.' . Order::status[$order->status])
            ];
        });

        $tender = OrderTender::where('order_id', $request->order_id)->where('company_id', auth()->user()->company_id)->first();

        return response()->json([
            'order'     => $order,
            'tender'    => $tender
        ]);
    }

    public function updateOrder(Request $request) {
        $order = Order::find($request->id);
        $order->update([
            'company_id'    => $request->company_id,
            'received_at'   => date('Y-m-d H:I'),
        ]);

        return response()->json([
            'order'     => $order,
        ]); 
    }


}
