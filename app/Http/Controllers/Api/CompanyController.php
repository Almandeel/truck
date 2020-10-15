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

    public function orderStatus(Request $request) {
        if(auth('api')->user()->company_id) {
            if($request->type == 'new') {
                $orders = Order::where('status', Order::ORDER_ACCEPTED)->orderBy('created_at', 'DESC')->get()->map(function($order) {
                    return [
                        'id'            => $order->id,
                        'order_type'    => $order->type,
                        'from'          => $order->from,
                        'to'            => $order->to,
                    ];
                });
            }

            if($request->type == 'done') {
                $orders = Order::where('company_id', auth('api')->user()->company_id)->where('status', Order::ORDER_DONE)->orderBy('created_at', 'DESC')->get()->map(function($order) {
                    return [
                        'id'            => $order->id,
                        'order_type'    => $order->type,
                        'from'          => $order->from,
                        'to'            => $order->to,
                    ];
                });
            }

            if($request->type == 'shipping') {
                $orders = Order::where('company_id', auth('api')->user()->company_id)->where('status', Order::ORDER_IN_SHIPPING)->orderBy('created_at', 'DESC')->get()->map(function($order) {
                    return [
                        'id'            => $order->id,
                        'order_type'    => $order->type,
                        'from'          => $order->from,
                        'to'            => $order->to,
                    ];
                });
            }

            if($request->type == 'road') {
                $orders = Order::where('company_id', auth('api')->user()->company_id)->where('status', Order::ORDER_IN_ROAD)->orderBy('created_at', 'DESC')->get()->map(function($order) {
                    return [
                        'id'            => $order->id,
                        'order_type'    => $order->type,
                        'from'          => $order->from,
                        'to'            => $order->to,
                    ];
                });
            }
            
            return response()->json($orders); 
        }else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function showOrder(Request $request) {
        if(auth('api')->user()->company_id) {
            $order = Order::with('items')->where('id', $request->order_id)->first();
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
        $order = Order::find($request->order_id);
        $tender = OrderTender::create([
            'order_id'      => $request->order_id,
            'company_id'    => auth('api')->user()->company_id,
            'price'         => $request->price,
            'duration'      => $request->duration,
        ]);

        $recipients = $order->addedOrder->pluck('fcm_token')->toArray();

        fcm()
        ->to($recipients)
        ->priority('high')
        ->timeToLive(0)
        ->notification([
            'title' => 'لديك عرض جديد',
            'body' => 'تم اضافة عرض جديد في الطلب رقم ' . $order->id,
        ])
        ->send();

        return response()->json(['message' => 'success'], 200);
    }

    public function UpdateStatus(Request $request) {
        $order = Order::find($request->order_id);

        if($order->status == Order::ORDER_IN_SHIPPING) {
            $order->update([
                'status' => Order::ORDER_IN_ROAD
            ]);
            return response()->json(['message' => 'Success', 200]);
        }

        if($order->status == Order::ORDER_IN_ROAD) {
            $order->update([
                'status' => Order::ORDER_DONE
            ]);
            return response()->json(['message' => 'Success', 200]);
        }

    }


}
