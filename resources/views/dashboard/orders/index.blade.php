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
            <h3 class="card-title float-right">قائمة الطلبات</h3>
            @if(!auth()->user()->hasRole('company'))
            @permission('orders-create')
                <a  href="{{ route('orders.create') }}" style="display:inline-block; margin-left:1%" class="btn btn-primary btn-sm float-left">
                    <i class="fa fa-plus"> اضافة</i>
                </a>
            @endpermission
            @endif
        </div>
        <div id="app" class="card-body">
                <table style="width:100%" id="datatable" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>رقم الطلب</th>
                        @role(['superadmin', 'services'])
                        <th>الاسم</th>
                        <th>رقم الهاتف</th>
                        @endrole
                        <th>نوع الشحن</th>
                        <th>منطقة الشحن</th>
                        <th>منطقة التفريغ</th>
                        <th>الحالة</th>
                        <th>تاريخ الانشاء</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $index=>$order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->id }}</td>
                            @role(['superadmin', 'services'])
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->phone }}</td>
                            @endrole
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <order-component></order-component> --}}
        </div>
    </div>
@endsection

{{-- @push('js')
<script  src="{{ asset('js/app.js') }}"></script>
@endpush --}}
