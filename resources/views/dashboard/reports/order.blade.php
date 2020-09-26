@extends('layouts.dashboard.report')

@section('title')
    طلب رقم {{ $order->id }}
@endsection

@section('content')
<table style="margin-bottom:3%" class="table table-bordered table-hover text-center bm-4">
    <thead>
        <tr>
            <th colspan="4">بيانات الطلب</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>اسم العميل</th>
            <td>{{ $order->name }}</td>
            <th>رقم الهاتف</th>
            <td>{{ $order->phone }}</td>
        </tr>
        <tr>
            <th>نوع الشحن</th>
            <td>{{ $order->type }}</td>
            <th>تاريخ الاضافة</th>
            <td>{{ $order->created_at->format('Y-m-d H:I') }}</td>
        </tr>
        <tr>
            <th>منطقة الشحن</th>
            <td>{{ $order->from }}</td>
            <th>منطقة التفريغ</th>
            <td>{{ $order->to }}</td>
        </tr>
        <tr>
            <th>شركة الشحن</th>
            <td>{{ $order->company->name ?? '' }}</td>
            <th>رقم هاتف الشركة</th>
            <td>{{ $order->company->phone ?? '' }}</td>
        </tr>
        <tr>
            <th>تاريخ الموافقة</th>
            <td>{{ $order->accepted_at }}</td>
            <th>تاريخ التوصيل</th>
            <td>{{ $order->received_at }}</td>
        </tr>
    </tbody>
</table>


<table class="table table-bordered table-hover text-center">
    <thead>
        <tr><th colspan="4">تفاصيل الطلب</th></tr>
        <tr>
            <th>#</th>
            <th>النوع</th>
            <th>العدد</th>
            <th>الوزن</th>
        </tr>
    </thead>
    @foreach ($order->items as $index=>$item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->type }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->weight }}</td>
        </tr>
    @endforeach
</table>
@endsection