@extends('layouts.dashboard.app', ['datatable' => true, 'modals' => ['zone']])

@section('title')
    المناطق
@endsection

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['المناطق'])
        @slot('url', ['#'])
        @slot('icon', ['list'])
    @endcomponent
    <div class="card">
        <div class="card-header">
            @permission('zones-create')
                <button  href="#" style="display:inline-block; margin-left:1%" class="btn btn-primary btn-sm pull-left zone" data-toggle="modal" data-target="#zoneModal">
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
                    @foreach ($zones as $zone)
                        <tr>
                            <td>{{ $zone->name }}</td>
                            <td>
                                @permission('zones-update')
                                    <button class="btn btn-warning btn-xs zone update" data-toggle="modal" data-target="#zoneModal" data-action="{{ route('zones.update', $zone->id) }}" data-name="{{ $zone->name }}"><i class="fa fa-edit"></i> تعديل </button>
                                @endpermission

                                {{-- @permission('zones-delete')
                                    <form style="display:inline-block;" action="{{ route('zones.destroy', $zone->id) }}?type=status" method="post">
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
