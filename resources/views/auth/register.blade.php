<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME') }} | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet"
        href="{{ asset('dashboard') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        * {
            direction: rtl
        }
        label {
            float: right;
        }
        .login-box, .register-box {
            width: 500px;
        }
        .login-page i {
            font-size: 20px;
            display: inline-block;
            margin-bottom:15px;
            color: rgb(134, 134, 134)
        }
        .border-top-red {
            border-top: 3px solid red;
            
        }
        .border-top-primary {
            border-top: 3px solid blue;
            
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>اهلا و سهلا بك في {{ env('APP_NAME') }}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="row">
            <div class="col-md-6" data-toggle="modal" data-target="#company">
                <div class="card text-center border-top-red" >
                    <div class="card-body">
                        <i class="fa fa-building"></i>
                        <h5>تسجيل كشركة</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6" data-toggle="modal" data-target="#customer">
                <div class="card text-center border-top-primary">
                    <div class="card-body">
                        <i class="fa fa-user"></i>
                        <h5>تسجيل كعميل</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- Modal -->
    <div class="modal fade" id="customer" tabindex="-1" role="dialog" aria-labelledby="customerTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="companyTitle">تسجيل كعميل</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
            </button>
            </div>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class=" mb-3">
                        <label>الاسم</label>
                        <input autocomplete="off"  required type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" placeholder="الاسم">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label>رقم الهاتف</label>
                        <input min="10" max="10" required autocomplete="off"  type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" name="phone" placeholder="رقم الهاتف">
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label>كلمة المرور</label>
                        <input required  type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="كلمة المرور">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn btn-primary">تسجيل </button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <div class="modal fade" id="company" tabindex="-1" role="dialog" aria-labelledby="companyTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="companyTitle">تسجيل كشركة</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
            </button>
            </div>
            <form action="{{ route('register') }}?type=company" method="post">
                @csrf
                <div class="modal-body">
                    <div class=" mb-3">
                        <label>الاسم</label>
                        <input required autocomplete="off" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" placeholder="الاسم">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label>رقم الهاتف</label>
                        <input required min="10" max="10" autocomplete="off"  type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" name="phone" placeholder="رقم الهاتف">
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label>العنوان</label>
                        <input required autocomplete="off"  type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" placeholder="العنوان">
                        @if ($errors->has('address'))
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label>كلمة المرور</label>
                        <input required  type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="كلمة المرور">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn btn-primary">تسجيل </button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('dashboard/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dashboard/dist/js/adminlte.min.js') }}"></script>
    
</body>

</html>