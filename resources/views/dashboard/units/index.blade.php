@extends('layouts.dashboard.app', ['datatable' => true, 'modals' => ['unit']])

@section('title')
    الوحدات
@endsection

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['الوحدات'])
        @slot('url', ['#'])
        @slot('icon', ['list'])
    @endcomponent
    <div class="card">
        <div class="card-header">
            @permission('units-create')
                <button  href="#" style="display:inline-block; margin-left:1%" class="btn btn-primary btn-sm pull-left unit" data-toggle="modal" data-target="#UnitModal">
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
                    @foreach ($units as $unit)
                        <tr>
                            <td>{{ $unit->name }}</td>
                            <td>
                                @permission('units-update')
                                    <button class="btn btn-warning btn-xs unit update" data-toggle="modal" data-target="#UnitModal" data-action="{{ route('units.update', $unit->id) }}" data-name="{{ $unit->name }}"><i class="fa fa-edit"></i> تعديل </button>
                                @endpermission

                                {{-- @permission('units-delete')
                                    <form style="display:inline-block;" action="{{ route('units.destroy', $unit->id) }}?type=status" method="post">
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
