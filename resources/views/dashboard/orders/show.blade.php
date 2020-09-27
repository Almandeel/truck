@extends('layouts.dashboard.app', ['datatable' => true])

@section('title')
    الطلبات | عرض
@endsection

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['الطلبات', 'عرض'])
        @slot('url', [route('orders.index'),'#'])
        @slot('icon', ['list', 'eye'])
    @endcomponent
    <div class="card">
        <div class="card-header">
            طلب رقم {{ $order->id }}
            @permission('orders-print')
                <a href="{{ route('reports.order', $order->id) }}" class="btn btn-secondary btn-sm float-left">طباعة</a>
            @endpermission


            @role('company')
                @if($order->status == \App\Order::ORDER_ACCEPTED)
                    <form style="display: inline-block; float:left" action="{{ route('orders.update', $order->id) }}?type=reserved" method="post">
                        @csrf 
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-check"> استلام الطلب</i>
                        </button>
                    </form>
                @endif

                @if($order->status == \App\Order::ORDER_IN_SHIPPING)
                @role('company')
                    <form style="display: inline-block; float:left" action="{{ route('orders.update', $order->id) }}?type=shipping" method="post">
                        @csrf 
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-check"> تم شحن الطلب </i>
                        </button>
                    </form>
                @endrole
            @endif

            @if($order->status == \App\Order::ORDER_IN_ROAD)
                @role('company')
                    <form style="display: inline-block; float:left" action="{{ route('orders.update', $order->id) }}?type=road" method="post">
                        @csrf 
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-check"> تم توصيل الطلب </i>
                        </button>
                    </form>
                @endrole
            @endif
            @endrole

        </div>
        <div class="card-body">
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
                        <th>تاريخ التسليم</th>
                        <td>{{ $order->received_at }}</td>
                        <th>تاريخ التوصيل</th>
                        <td>{{ $order->delivered_at }}</td>
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
        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection

