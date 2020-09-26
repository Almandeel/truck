<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function order($id) {
        $order = Order::find($id);
        $pdf = PDF::loadView('dashboard.reports.order', compact('order'));
        return $pdf->stream('order.pdf');
    }
}
