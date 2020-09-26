@extends('layouts.dashboard.app', ['datatable' => true, 'modals' => ['vehicle']])

@section('title')
    المركبات
@endsection

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['المركبات'])
        @slot('url', ['#'])
        @slot('icon', ['list'])
    @endcomponent
    <div class="card">
        <div class="card-header">
            @permission('vehicles-create')
                <button  href="#" style="display:inline-block; margin-left:1%" class="btn btn-primary btn-sm pull-left vehicle" data-toggle="modal" data-target="#vehicleModal">
                    <i class="fa fa-user-plus"> اضافة</i>
                </button>
            @endpermission
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->name }}</td>
                            <td>
                                @permission('vehicles-update')
                                    <button class="btn btn-warning btn-xs vehicle update" data-toggle="modal" data-target="#vehicleModal" data-action="{{ route('vehicles.update', $vehicle->id) }}" data-name="{{ $vehicle->name }}"><i class="fa fa-edit"></i> تعديل </button>
                                @endpermission

                                {{-- @permission('vehicles-delete')
                                    <form style="display:inline-block;" action="{{ route('vehicles.destroy', $vehicle->id) }}?type=status" method="post">
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
