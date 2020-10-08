@extends('layouts.dashboard.app')

@section('title')
    الطلبات | اضافة
@endsection

@push('css')
    <style>
        .card {
            padding-bottom:5%
        }
    </style>
@endpush

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['الطلبات' , 'اضافة'])
        @slot('url', [route('orders.index'),'#'])
    @endcomponent
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">اضافة طلب</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="order_type">نوع الشحن</label>
                    </div>
                    <select class="custom-select" name="order_type"  id="order_type">
                        <option id="none" value="">نوع الشحن</option>
                        <option id="container" value="حاويات">شحن حاويات</option>
                        <option id="goods" value="بضائع">شحن بضائع</option>
                        <option id="cars" value="مركبات">شحن مركبات</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>اسم العميل</label>
                            <input {{ auth()->user()->hasRole('customer') ? 'readonly' .' ' . "value=" . auth()->user()->name  : '' }} type="text" name="name" class="form-control" placeholder="اسم العميل">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input {{ auth()->user()->hasRole('customer') ? 'readonly' .' ' . "value=" . auth()->user()->phone  : '' }} type="number" name="phone" class="form-control" placeholder="رقم الهاتف">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>منطقة الشحن</label>
                            <select name="from" class="form-control">
                                <option value="">منطقة الشحن</option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->name }}">{{ $zone->name }}</option>
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
                                    <option value="{{ $zone->name }}">{{ $zone->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>تاريخ الشحن</label>
                        <input type="date" name="shipping_date" class="form-control" placeholder="تاريخ الشحن">
                    </div>
                    <div class="col-md-6">
                        <label>اسم المخلص</label>
                        <input type="text" name="savior_name" class="form-control" placeholder="اسم المخلص">
                    </div>
                    <div class="col-md-6">
                        <label>اسم رقم هاتف المخلص</label>
                        <input type="number" name="savior_phone" class="form-control" placeholder="رقم هاتف المخلص">
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
                                <th>الوحدة</th>
                                <th>نوع العربة</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                    <button id="add-items" class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus"></i>اضافة</button>
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> اكمال العملية</button>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('js')
    <script type="application/javascript">
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
            <td>
                -
            </td>
            <td>
                -
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
            <td>
                <select class="custom-select form-control"  name="unit[]">
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="custom-select form-control"  name="item_type[]">
                    <option value="شبك 40 طن">شبك 40 طن</option>
                    <option value="شبك 50 طن">شبك 50 طن</option>
                </select>
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
            <td>
                -
            </td>
            <td>
                -
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
