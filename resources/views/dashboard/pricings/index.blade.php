@extends('layouts.dashboard.app', ['datatable' => true, 'modals' => ['pricing']])

@section('title')
    الاسعار
@endsection

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['الاسعار'])
        @slot('url', ['#'])
        @slot('icon', ['list'])
    @endcomponent
    <div class="card">
        <div class="card-header">
            @permission('pricings-create')
                <button  href="#" style="display:inline-block; margin-left:1%" class="btn btn-primary btn-sm pull-left pricing" data-toggle="modal" data-target="#pricingModal">
                    <i class="fa fa-user-plus"> اضافة</i>
                </button>
            @endpermission
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>القيمة</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pricings as $pricing)
                        <tr>
                            <td>{{ $pricing->name }}</td>
                            <td>{{ $pricing->amount }}</td>
                            <td>
                                @permission('pricings-update')
                                    <button class="btn btn-warning btn-xs pricing update" data-toggle="modal" data-target="#pricingModal" data-action="{{ route('pricings.update', $pricing->id) }}" data-name="{{ $pricing->name }}" data-amount="{{ $pricing->amount }}"><i class="fa fa-edit"></i> تعديل </button>
                                @endpermission

                                {{-- @permission('pricings-delete')
                                    <form style="display:inline-block;" action="{{ route('pricings.destroy', $pricing->id) }}?type=status" method="post">
                                        @csrf 
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-xs" style="margin:0 5px" type="submit"><i class="fa fa-edit"></i> حذف </a>
                                    </form>
                                @endpermission --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
