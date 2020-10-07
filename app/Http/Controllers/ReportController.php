<?php

namespace App\Http\Controllers;

use PDF;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function order($id) {
        $order = Order::find($id);

        $config = ['instanceConfigurator' => function($pdf) {
            $pdf->SetDocTemplate(base_path('resources/pdf/tarhil.pdf'), true);
        }];
        $pdf = PDF::loadView('dashboard.reports.order', compact('order'), [], $config);
        return $pdf->stream('order.pdf');
    }
}
