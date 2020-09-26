@extends('layouts.dashboard.app', ['datatable' => true])

@section('title')
  اضافة مستخدم
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/icheck/all.css') }}">
@endpush


@section('content')
    {{-- @component('partials._breadcrumb')
        @slot('title', ['users', 'add'])
        @slot('url', [route('users.index'), '#'])
        @slot('icon', ['users', 'plus'])
    @endcomponent --}}
    <form id="form" action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      اضافة
                    </div>
                    <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label>الاسم</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="الاسم" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>رقم الهاتف</label>
                                  <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="رقم الهاتف" required>
                              </div>
                          </div>
						            </div>
						            <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('users.password')</label>
                                <input id="password" type="password" class="form-control" name="password" placeholder="@lang('users.password')" required>
                            </div>
                          </div>
                          <div class="col-md-6">
							              <div class="form-group">
                                    <label>@lang('users.password_confirmation')</label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="@lang('users.password_confirmation')" data-parsley-equalto="#password" required>
								            </div>
                          </div>
                          {{-- <div class="col-md-6">
							              <div class="form-group">
                                <label>الحالة</label>
                                <select name="status" class="form-control">
                                  <option value="0">@lang('users.deactive')</option>
                                  <option value="1">@lang('users.active')</option>
                                </select>
								            </div>
                          </div> --}}
                        </div>
                    </div>
                    <div class="card-footer">
                      <div class="row">
                        {{-- <div class="col-md-6">
                            <label>
                                <input type="radio" name="next" value="back" checked="true">
                                <span>@lang('users.save_and_add_new')</span>
                            </label>
                            <label>
                                <input type="radio" name="next" value="list">
                                <span>@lang('users.save_and_back')</span>
                            </label>
                        </div> --}}
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-plus"></i> @lang('users.add')</button>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">

                <div class="accordion" id="accordionExample">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          @lang('users.roles')
                        </button>
                      </h2>
                    </div>
                
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body">
                        @foreach ($roles as $role)
                          <div class="col-md-3">
                              <div class="form-group" dir="rtl">
                                  <label>
                                    {{ $role->name }}
                                    <input type="checkbox" class="icheckbox_square-green" name="roles[]" value="{{ $role->id }}">
                                  </label>
                              </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>

                <div class="accordion" id="permissions">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#permission" aria-expanded="true" aria-controls="permission">
                          @lang('users.permissions')
                        </button>
                      </h2>
                    </div>
                
                    <div id="permission" class="collapse show" aria-labelledby="headingOne" data-parent="#permissions">
                      <div class="card-body">
                        <table id="users-table" class="table table-bordered table-hover text-left" dir="rtl">
                          <thead>
                            <tr>
                              <th>@lang('users.permission') </th>
                              <th>@lang('users.permission')</th>
                              <th>@lang('users.permission')</th>
                              <th>@lang('users.permission')</th>
                            </tr>
                          </thead>
                          @php $missing_col = count($permissions) % 4 @endphp
                          @php $col = 4 - $missing_col @endphp
                          @foreach ($permissions as $index=>$permission)
                            @if($index % 4 == 0 )
                              <tr>
                            @endif
                            @if( ( count($permissions) - ($index) ) > $missing_col  )
                              <td>
                                  <label>
                                    {{ $permission->display_name  }}
                                    <input type="checkbox" class="icheckbox_square-green" name="permissions[]" value="{{ $permission->id }}">
                                  </label>
                              </td>
                            @else
                            @if($missing_col == 1)
                              @for ($i = 0; $i < $col; $i++)
                                  <td>
                                    <label>-</label>
                                  </td>
                              @endfor
                            @endif
                            @if($missing_col > 0)
                              <td>
                                <label>
                                  {{ $permission->display_name  }}
                                  <input type="checkbox" class="icheckbox_square-green" name="permissions[]" value="{{ $permission->id }}">
                                </label>
                              </td>
                              @php $missing_col-- @endphp
                            @endif

                            @endif
                              @if($index + 1 % 4 == 0)
                                </tr>
                              @endif
                          @endforeach
                        </table>
                      </div>
                    </div>
                  </div>
                </div>


                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add </button>


                {{-- <div class="card card-solid">
                  <div class="card-header with-border">
                    <h3 class="card-title">@lang('users.roles_and_permissions')</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="card-group" id="accordion">
                      <div class="panel card card-primary">
                        <div class="card-header with-border">
                          <h4 class="card-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                              
                            </a>
                          </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                          <div class="box-body text-left">
                            
                          </div>
                        </div>
                      </div>
                      <div class="panel card card-danger">
                        <div class="card-header with-border">
                          <h4 class="card-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            </a>
                          </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                          <div class="card-body">
                            
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div> --}}
                <!-- /.card -->
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script src="{{ asset('dashboard/plugins/icheck/icheck.min.js') }}"></script>
    <script>
      $(document).ready(function(){
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-green',
          increaseArea: '20%' // optional
        });
      });
      </script>
@endpush
