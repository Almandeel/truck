@extends('layouts.dashboard.app', ['datatable' => true, 'modals' => ['tender']])

@section('title')
    الطلبات | عرض
@endsection

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['الطلبات', 'عرض'])
        @slot('url', [route('orders.index'),'#'])
    @endcomponent
    <div class="card">
        <div class="card-header">
            طلب رقم {{ $order->id }}

            @permission('orders-print')
                <a href="{{ route('reports.order', $order->id) }}" target="_blank" class="btn btn-secondary btn-sm float-left">طباعة</a>
            @endpermission

            @if($order->status == \App\Order::ORDER_DEFAULT)
                @permission('orders-update')
                <form class="float-left" style="display: inline-block; margin:0 1%" action="{{ route('orders.update', $order->id) }}?type=accepted" method="post">
                    @csrf 
                    @method('PUT')
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="fa fa-check"> موافقة</i>
                    </button>
                </form>
                @endpermission
            @endif

            @role('company')
                @if($order->status == \App\Order::ORDER_ACCEPTED && !in_array(auth()->user()->company_id, $tenders))
                        <button type="button" class="btn btn-success btn-sm float-left" data-toggle="modal" data-target="#TenderyModal">
                            <i class="fa fa-check"> استلام الطلب</i>
                        </button>
                @endif

                @if($order->status == \App\Order::ORDER_IN_ROAD)
                    <form style="display: inline-block; float:left" action="{{ route('orders.update', $order->id) }}?type=road" method="post">
                        @csrf 
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-check"> تم توصيل الطلب </i>
                        </button>
                    </form>
                @endif

                @if($order->status == \App\Order::ORDER_IN_SHIPPING)
                    <form style="display: inline-block; float:left" action="{{ route('orders.update', $order->id) }}?type=shipping" method="post">
                        @csrf 
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-check"> تم شحن الطلب </i>
                        </button>
                    </form>
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
                    @role(['superadmin', 'services'])
                        <tr>
                            <th>اسم العميل</th>
                            <td>{{ $order->name }}</td>
                            <th>رقم الهاتف</th>
                            <td>{{ $order->phone }}</td>
                        </tr>
                    @endrole
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
                    @role(['superadmin', 'services'])
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
                    @endrole

                    @if(auth()->user()->hasRole(['superadmin', 'services']))
                        <tr>
                            <th>اسم المخلص</th>
                            <td>{{ $order->savior_name }}</td>
                            <th>رقم هاتف المخلص</th>
                            <td>{{ $order->savior_phone }}</td>
                        </tr>
                    @else 
                        @if($order->status != \App\Order::ORDER_DEFAULT && $order->status != \App\Order::ORDER_ACCEPTED)
                            <tr>
                                <th>اسم المخلص</th>
                                <td>{{ $order->savior_name }}</td>
                                <th>رقم هاتف المخلص</th>
                                <td>{{ $order->savior_phone }}</td>
                            </tr>
                        @endif
                    @endif
                    <tr >
                        <th colspan="2">تاريخ الشحن</th>
                        <td colspan="2">{{ $order->shipping_date }}</td>
                    </tr>
                    
                    @permission('pricings-read')
                        <tr>
                            <th>سعر التوصيل</th>
                            <td>{{ $order->amount }}</td>
                            <th>العمولة</th>
                            <td>{{ $order->net }}</td>
                        </tr>
                    @endpermission
                    
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

            @if(in_array($order->status, [\App\Order::ORDER_DEFAULT, \App\Order::ORDER_ACCEPTED]))
            @role(['superadmin', 'customer', 'services'])
                <table class="table table-bordered table-hover text-center">
                    <thead>
                        <tr><th colspan="5">افضل العروض</th></tr>
                        <tr>
                            <th>#</th>
                            @role(['superadmin', 'services'])
                                <th>اسم الشركة</th>
                            @endrole
                            <th>مدة الشحن</th>
                            <th>السعر</th>
                            <th>خيارات</th>
                        </tr>
                    </thead>
                    @foreach ($order->tenders->where('status', 0) as $index=>$tender)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            @role(['superadmin', 'services'])
                                <td>{{ $tender->company->name }}</td>
                            @endrole
                            <td>{{ $tender->duration }}</td>
                            <td>{{ $tender->price }}</td>
                            <td>
                                <form style="display: inline-block" action="{{ route('orders.update', $order->id) }}?type=received" method="post">
                                    @csrf 
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa fa-check"> موافقة </i>
                                        <input type="hidden" name="company_id" value="{{ $tender->company_id }}">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endrole
            @endif
        </div>
        <div class="card-footer">
            
        </div>
    </div>
@endsection

