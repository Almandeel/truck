<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\OrderTender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function profile() {
        return response()->json(auth('api')->user());
    }

    public function newOrders() {
        if(auth('api')->user()->company_id) {
            $orders = Order::where('status', Order::ORDER_ACCEPTED)->get()->map(function($order) {
                return [
                    'id'            => $order->id,
                    'order_type'    => $order->type,
                    'from'          => $order->from,
                    'to'            => $order->to,
                ];
            });
            return response()->json($orders); 
        }else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function oldOrders() {
        if(auth('api')->user()->company_id) {
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
        }else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function showOrder(Request $request) {
        if(auth('api')->user()->company_id) {
            $order = Order::with('items')->where('id', $request->order_id)->get()->map(function ($order) {
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
        }else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function updateOrder(Request $request) {
        $tender = OrderTender::create([
            'order_id'      => $request->order_id,
            'company_id'    => auth('api')->user()->company_id,
            'price'         => $request->price,
            'duration'      => $request->duration,
        ]);
        // return $this->showOrder($order->id);
    }


}
