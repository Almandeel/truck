@extends('layouts.dashboard.app', ['datatable' => true, 'modals' => ['company']])

@section('title')
    الشركات
@endsection

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['الشركات'])
        @slot('url', ['#'])
        @slot('icon', ['list'])
    @endcomponent
    <div class="card">
        <div class="card-header">
            @permission('companies-create')
                <button  href="#" style="display:inline-block; margin-left:1%" class="btn btn-primary btn-sm pull-left company" data-toggle="modal" data-target="#CompanyModal">
                    <i class="fa fa-user-plus"> اضافة</i>
                </button>
            @endpermission
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>رقم الهاتف</th>
                        <th>العنوان</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->phone }}</td>
                            <td>{{ $company->address }}</td>
                            <td>
                                @permission('enteries-read')
                                    <a href="{{ route('companies.show', $company->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> كشف حساب</a>
                                @endpermission
                                @permission('companies-update')
                                    <button class="btn btn-warning btn-xs company update " data-toggle="modal" data-target="#CompanyModal" data-action="{{ route('companies.update', $company->id) }}" data-name="{{ $company->name }}" data-phone="{{ $company->phone }}" data-address="{{ $company->address }}"><i class="fa fa-edit"></i> تعديل </button>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
