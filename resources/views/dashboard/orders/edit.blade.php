@extends('layouts.dashboard.app')

@section('title')
    الطلبات | تعديل
@endsection

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['الطلبات' , 'تعديل'])
        @slot('url', [route('orders.index'),'#'])
        @slot('icon', ['list', 'edit'])
    @endcomponent
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">تعديل طلب</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('orders.update', $order->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="order_type">نوع الشحن</label>
                    </div>
                    <select class="custom-select" name="order_type"  id="order_type">
                        <option id="none" value="">نوع الشحن</option>
                        <option id="container" value="حاويات" {{ $order->type == 'حاويات' ? 'selected' : '' }}>شحن حاويات</option>
                        <option id="goods" value="بضائع" {{ $order->type == 'بضائع' ? 'selected' : '' }}>شحن بضائع</option>
                        <option id="cars" value="مركبات" {{ $order->type == 'مركبات' ? 'selected' : '' }}>شحن مركبات</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>اسم العميل</label>
                            <input type="text" name="name" class="form-control" placeholder="اسم العميل" value="{{ $order->name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="number" name="phone" class="form-control" placeholder="رقم الهاتف" value="{{ $order->phone }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>منطقة الشحن</label>
                            <select name="from" class="form-control">
                                <option value="">منطقة الشحن</option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->name }}" {{ $order->from == $zone->name ? 'selected' : '' }}>{{ $zone->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>منطقة التفريغ</label>
                            <select name="to" class="form-control">
                                <option value="">منطقة التفريغ</option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->name }}" {{ $order->to == $zone->name ? 'selected' : '' }}>{{ $zone->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>تاريخ الشحن</label>
                        <input type="date" name="shipping_date" class="form-control" value="{{ $order->shipping_date }}" placeholder="تاريخ الشحن">
                    </div>
                    <div class="col-md-6">
                        <label>اسم المخلص</label>
                        <input type="text" name="savior_name" value="{{ $order->savior_name }}" class="form-control" placeholder="اسم المخلص">
                    </div>
                    <div class="col-md-6">
                        <label>اسم رقم هاتف المخلص</label>
                        <input type="number" name="savior_phone" value="{{ $order->savior_phone }}" class="form-control" placeholder="رقم هاتف المخلص">
                    </div>
                </div>
                <hr>
                <div class="container">
                    <table id="table-items" class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th>النوع</th>
                                <th>العدد</th>
                                <th>الوزن</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $index=>$item)
                                <tr>
                                    <td>
                                        <select class="custom-select form-control"  name="item_type[]">
                                            <option value="حاوية 20 قدم" {{ $item->type == 'حاوية 20 قدم' ? 'selected' : '' }}>حاوية 20 قدم</option>
                                            <option value="حاوية 40 قدم" {{ $item->type == 'حاوية 40 قدم' ? 'selected' : '' }}>حاوية 40 قدم</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="quantity[]" class="form-control" placeholder="العدد" value="{{ $item->quantity }}">
                                    </td>
                                    <td>
                                        <input type="number" name="weight[]" class="form-control" placeholder="الوزن" value="{{ $item->weight }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                    <button id="add-items" class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus"></i>اضافة</button>
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i>حفظ التعديلات</button>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let container = 
        `
        <tr>
            <td>
                <select class="custom-select form-control"  name="item_type[]">
                    <option value="حاوية 20 قدم">حاوية 20 قدم</option>
                    <option value="حاوية 40 قدم">حاوية 40 قدم</option>
                </select>
            </td>
            <td>
                <input type="number" name="quantity[]" class="form-control" placeholder="العدد">
            </td>
            <td>
                <input type="number" name="weight[]" class="form-control" placeholder="الوزن">
            </td>
        </tr>
        `

        let goods = 
        `
        <tr>
            <td>
                <input type="text" name="item_type[]" class="form-control" placeholder="البضاعة">
            </td>
            <td>
                <input type="number" name="quantity[]" class="form-control" placeholder="العدد">
            </td>
            <td>
                <input type="number" name="weight[]" class="form-control" placeholder="الوزن">
            </td>
        </tr>
        `

        let cars = 
        `
        <tr>
            <td>
                <select class="custom-select form-control"  name="item_type[]">
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->name }}">{{ $vehicle->name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="quantity[]" class="form-control" placeholder="العدد">
            </td>
            <td>
                <input type="number" name="weight[]" class="form-control" placeholder="الوزن">
            </td>
        </tr>
        `

        $('#add-items').click(function () {
            let order_type = $('#order_type').val()
            console.log(order_type)

            if(order_type == 'حاويات') {
                $('#table-items tbody').append(container)
            }

            if(order_type == 'بضائع') {
                $('#table-items tbody').append(goods)
            }

            if(order_type == 'مركبات') {
                $('#table-items tbody').append(cars)
            }

            if(order_type == '') {
                alert('اختار نوع الشحن')
            }
        })
    </script>
@endpush
