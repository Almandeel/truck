@extends('layouts.dashboard.app', ['datatable' => true])

@section('title')
    الطلبات
@endsection

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['الطلبات'])
        @slot('url', ['#'])
        @slot('icon', ['list'])
    @endcomponent
    <div class="card">
        <div class="card-header">
            @if(!auth()->user()->hasRole('company'))
            @permission('orders-create')
                <a  href="{{ route('orders.create') }}" style="display:inline-block; margin-left:1%" class="btn btn-primary btn-sm pull-left">
                    <i class="fa fa-plus"> اضافة</i>
                </a>
            @endpermission
            @endif
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>رقم الهاتف</th>
                        <th>نوع الشحن</th>
                        <th>منطقة الشحن</th>
                        <th>منطقة التفريغ</th>
                        <th>الحالة</th>
                        <th>تاريخ الانشاء</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->type }}</td>
                            <td>{{ $order->from }}</td>
                            <td>{{ $order->to }}</td>
                            <td>
                                @if($order->status == \App\Order::ORDER_DEFAULT)
                                    في الانتظار
                                @endif
                                @if($order->status == \App\Order::ORDER_ACCEPTED)
                                    تمت الموافقة
                                @endif
                                @if($order->status == \App\Order::ORDER_IN_SHIPPING)
                                    في الشحن
                                @endif
                                @if($order->status == \App\Order::ORDER_IN_ROAD)
                                    في الطريف
                                @endif
                                @if($order->status == \App\Order::ORDER_DONE)
                                    تم التسليم
                                @endif
                                @if($order->status == \App\Order::ORDER_CANCEL)
                                    تم الالغاء
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('Y-m-d H:I') }}</td>
                            <td>
                                @permission('orders-read')
                                    <a  href="{{ route('orders.show', $order->id) }}" class="btn btn-default btn-sm">
                                        <i class="fa fa-read"> عرض</i>
                                    </a>
                                @endpermission
                                @permission('orders-update')
                                    <a  href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"> تعديل</i>
                                    </a>
                                @endpermission
                                @if($order->status == \App\Order::ORDER_DEFAULT)
                                    @permission('orders-update')
                                    <form style="display: inline-block" action="{{ route('orders.update', $order->id) }}?type=accepted" method="post">
                                        @csrf 
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fa fa-check"> موافقة</i>
                                        </button>
                                    </form>
                                    @endpermission
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
