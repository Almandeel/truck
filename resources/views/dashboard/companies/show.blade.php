@extends('layouts.dashboard.app', ['datatable' => true, 'modals' => ['payment']])

@section('title')
    الشركات  | كشف حساب
@endsection

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['الشركات', 'كشف حساب'])
        @slot('url', [route('companies.index'), '#'])
        @slot('icon', ['list', 'eye'])
    @endcomponent
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <td>{{ $company->name }}</td>
                        <th>رقم الهاتف</th>
                        <td>{{ $company->phone }}</td>
                        <th>مدين</th>
                        <td>{{ number_format($debt) }}</td>
                        <th>دائن</th>
                        <td>{{ number_format($cridet) }}</td>
                        <th>الصافي</th>
                        <td>{{ number_format($cridet - $debt) }}</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            @permission('payments-create')
                <button  href="#" style="display:inline-block; margin-left:1%" class="btn btn-primary btn-sm pull-left payment" data-company="{{ $company->id }}" data-toggle="modal" data-target="#paymentModal">
                    <i class="fa fa-user-plus"> اضافة دفعة</i>
                </button>
            @endpermission
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>القيمة</th>
                        <th>التفاصيل</th>
                        <th>التاريخ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enteries as $index=>$entry)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $entry->amount }}</td>
                            <td>{{ $entry->details }}</td>
                            <td>{{ $entry->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
