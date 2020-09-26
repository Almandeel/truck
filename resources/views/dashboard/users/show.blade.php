@extends('layouts.dashboard.app')

@section('title')
    @lang('global.edit')
@endsection

@section('content')
    {{-- @component('partials._breadcrumb')
        @slot('title', ["users", "show"] )
        @slot('url', [route('users.index'), '#'])
        @slot('icon', ['users', 'eye'])
    @endcomponent --}}
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $user->username }}</h3>
                </div>
            </div>
        </div>
    </div>
<form action="{{ route('users.destroy', $user->id) }}" method="POST">
        @csrf
        {{ method_field('DELETE') }}
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <table class="table table-borderd">
                            <tr>
                                <th>@lang('users.username')</th>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <th>@lang('users.email')</th>
                                <td>{{ $user['email'] }}</td>
                            </tr>
                            <tr>
                                <th>الحالة</th>
                                <td>{{ $user->status ? 'مفعل' : 'غير مفعل' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        @if(request()->delete)
                            @permission('users-delete')
                                <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> حذف </button>
                            @endpermission
                        @else
                            @permission('users-delete')
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>  تعديل </a>
                            @endpermission
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection