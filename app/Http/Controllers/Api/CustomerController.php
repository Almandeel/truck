<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\Entery;
use App\Account;
use App\Pricing;
use App\OrderItem;
use App\OrderTender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //

    public function profile() {
        return response()->json(auth('api')->user());
    }

    public function orders() {
        $orders = Order::with('items')->where('user_add_id', auth('api')->user()->id)->orderBy('created_at', 'DESC')->get()->map(function($order) {
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

        return response()->json($orders); 
    }

    public function order(Request $request) {

        $validator = Validator::make($request->all(), [
            'name'              => 'required | string | max:45',  
            'phone'             => 'required | string | max:255',
            'from'              => 'required | string',
            'to'                => 'required | string',
            'order_type'        => 'required | string',
            'shipping_date'     => 'required | string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages(),
            ]);
        }
        
        $order = Order::create([
            'type'          => $request->order_type,
            'name'          => $request->name,
            'phone'         => $request->phone,
            'from'          => $request->from,
            'to'            => $request->to,
            'shipping_date' => $request->shipping_date,
            'savior_name'   => $request->savior_name,
            'savior_phone'  => $request->savior_phone,
            'car_type'      => $request->car_type,
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

    public function showOrder(Request $request) {
        $order = Order::with('items')->where('id', $request->order_id)->where('user_add_id', auth('api')->user()->id)->first();
        $tenders = OrderTender::where('order_id', $request->order_id)->where('status', 0)->get()->map(function($tender) {
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
        $pricing = Pricing::first();

        $net = ($order->tenders->where('company_id', $request->company_id)->first()->price * $pricing->amount) / 100;

        $order->update([
            'status'        => Order::ORDER_IN_SHIPPING,
            'company_id'    => $request->company_id,
            'received_at'   => date('Y-m-d H:I'),
            'amount' => $order->tenders->where('company_id', $request->company_id)->first()->price,
            'ratio'  => $pricing->amount,
            'net'    => $net,
        ]);

        $entries = Entery::create([
            'amount'    => $net,
            'from_id'   => $order->company->account_id,
            'to_id'     => Account::ACCOUNT_SAFE,
            'details'   => 'عمولة من الطلب رقم ' . $order->id,
            'type'      => Entery::TYPE_INCOME,
        ]);

        $recipients = $order->company->user->pluck('fcm_token')->toArray();

        fcm() 
        ->to($recipients)
        ->priority('high')
        ->timeToLive(0)
        ->notification([
            'title' => 'تمت الموافقة على عرضك',
            'body' => 'تمت الموافقة على عرضك في الطلب رقم ' . $order->id,
        ])
        ->send();

        return response()->json(['message' => 'success'], 200);
    }

}
