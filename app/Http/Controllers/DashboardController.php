<?php

namespace App\Http\Controllers;

use App\Bill;
use App\User;
use App\Order;
use App\Driver;
use App\Market;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $search_order = null;
        if($request->order_id){
            $search_order = Order::where('order_number', $request->order_id)->first();
        }
        return view('dashboard.index');
    }
}
