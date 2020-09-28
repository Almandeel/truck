@extends('layouts.dashboard.app', ['datatable' => true])

@section('title')
    users
@endsection

@section('content')
    {{-- @component('partials._breadcrumb')
        @slot('title', ['users'])
        @slot('url', ['#'])
        @slot('icon', ['users'])
    @endcomponent --}}
    <div class="card">
        <div class="card-header">
            @permission('users-create')
                <a  href="{{ route('users.create') }}" style="display:inline-block; margin-left:1%" class="btn btn-primary btn-sm pull-left" >
                    <i class="fa fa-user-plus"> اضافة</i>
                </a>
            @endpermission

            @permission('roles-create')
                <a  href="{{ route('roles.index') }}" style="display:inline-block; margin-left:1%" class="btn btn-primary btn-sm pull-left" >
                    <i class="fa fa-user"> Permissions</i>
                </a>
            @endpermission


        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>رقم الهاتف</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->phone }}</td>
                            <td>
                                {{-- @permission('users-read')
                                    <a class="btn btn-info btn-xs" href="{{ route('users.show', $u->id) }}"><i class="fa fa-eye"></i> عرض </a>
                                @endpermission --}}

                                @permission('users-update')
                                    <a class="btn btn-warning btn-xs" href="{{ route('users.edit', $u->id) }}"><i class="fa fa-edit"></i> تعديل </a>
                                    <form style="display:inline-block" action="{{ route('users.update', $u->id) }}?type=status" method="post">
                                        @csrf 
                                        @method('PUT')
                                        <button class="btn btn-{{ $u->status ? 'danger' : 'success' }} btn-xs" type="submit"><i class="fa fa-{{ $u->status ? 'times' : 'check' }}"></i> {{$u->status ? 'الغاء التفعيل' : 'تفعيل' }} </a>
                                    </form>
                                @endpermission

                                @permission('users-delete')
                                <form style="display:inline-block;" action="{{ route('users.destroy', $u->id) }}?type=status" method="post">
                                    @csrf 
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-xs" style="margin:0 5px" type="submit"><i class="fa fa-edit"></i> حذف </a>
                                </form>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
