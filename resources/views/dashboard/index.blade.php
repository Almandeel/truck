@extends('layouts.dashboard.app')
@section('title')
الرئيسية
@endsection
@section('content')


@role('superadmin')
<div class="">

    <h5 class="mt-4 mb-2"></h5>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-info">
                <span class="info-box-icon"><i class="fa fa-list"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">الطلبات الجديدة</span>
                    <span class="info-box-number">{{ $order_default }}</span>
                    
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-warning">
                <span class="info-box-icon"><i class="fas fa-bookmark"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">الطلبات الجارية</span>
                    <span class="info-box-number">{{ $order_in_road }}</span>
                    
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="far far fa-thumbs-up"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">الطلبات المكتملة</span>
                    <span class="info-box-number">{{ $order_done }}</span>
                    
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

    </div>

    <h5 class="mt-4 mb-2"></h5>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box bg-danger">
                <span class="info-box-icon"><i class="fas fa-building"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">كل الشركات </span>
                    <span class="info-box-number">{{ $companies }}</span>
                    
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box bg-danger">
                <span class="info-box-icon"><i class="fas fa-building"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">كل المستخدمين </span>
                    <span class="info-box-number">{{ $users }}</span>
                    
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>

</div>
@endrole

@endsection
