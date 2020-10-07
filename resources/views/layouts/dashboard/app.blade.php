<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title> ترحيل | @yield('title') </title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dashboard/dist/css/adminlte.min.css') }}">

    @if(app()->getlocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('dashboard/css/rtl.css') }}">
    @endif

    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">

    @stack('css')
    {{-- custome style --}}

    <style>
        * {
            font-family: 'Amiri', serif;
        }
        .modal-header {
            direction:rtl;
        }

        #swal2-content {
            text-align: center;
        }

        .navbar-light .navbar-nav .nav-link, .navbar-light .navbar-nav .nav-link:hover, .navbar-light .navbar-nav .nav-link:focus {
            color: #fff;
        }

        .navbar-white {
            background-color: #e33113;
        }

        aside {
            background-color:#000 !important;
        }

        [class*=sidebar-light-] .sidebar a , [class*=sidebar-light-] .sidebar a:hover {
            color: #fff
        }

        .nav-item .nav-link.active {
            background-color: #e33113 !important;
            color: #fff
        }
        
        .os-content {
            padding: 0 !important;
            height: 0 !important;
        }

        .layout-navbar-fixed .wrapper .sidebar-light-primary .brand-link:not([class*=navbar]) {
            background-color: #e33113;
            color: #fff;
            text-align: center;
        }
    </style>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- jQuery -->
    <script type="application/javascript" src="{{ asset('dashboard/plugins/jquery/jquery.min.js') }}"></script>
</head>

<body  class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <div id="app">

        <div class="wrapper">
    
            @include('partials.navbar')
    
            @include('partials.main-sidebar')
    
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="">
                        
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
    
                <div class="container-fluid">
                    @include('partials.messages')
                    @yield('content')
                </div>
            </div>
            <!-- /.content-wrapper -->
    
            <!-- Main Footer -->
            <footer class="main-footer">
                <strong>كل الحقوق محفوظة لشركة ترحيل</strong>
                <div class="float-left d-none d-sm-inline-block">
                    <b>Version</b> 1.0.0
                </div>
            </footer>
    
    
            <!-- Modal -->
            <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title text-right" id="profileModalLabel">الملف الشخصي</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                    </div>
                    <form action="{{ route('users.profile') }}" method="post">
                        <div class="modal-body">
                            @csrf 
                            @method('PUT')
                            <div class="form-group">
                                <label>رقم الهاتف</label>
                                <input type="text" name="phone" class="form-control" placeholder="رقم الهاتف" required value="{{ auth()->user()->phone }}">
                            </div>
                            <div class="form-group">
                                <label>كلمة المرور القديمة </label>
                                <input type="password" name="old_password" class="form-control" placeholder="كلمة المرور القديمة " required>
                            </div>
                            <div class="form-group">
                                <label>كلمة المرور الجديدة </label>
                                <input type="password" name="password" class="form-control" placeholder="كلمة المرور الجديدة " >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
        
        
    @if(isset($datatable))
    <!-- DataTables -->
    <link type="application/javascript" rel="stylesheet" href="{{ asset('dashboard') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link  type="application/javascript" rel="stylesheet" href="{{ asset('dashboard') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <!-- DataTables -->
    <script type="application/javascript" src="{{ asset('dashboard') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script type="application/javascript" src="{{ asset('dashboard') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script type="application/javascript" src="{{ asset('dashboard') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script type="application/javascript" src="{{ asset('dashboard') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script type="application/javascript">
        $(function () {
            $('#datatable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "bDestroy": true,
                'oLanguage'    : {
						"sEmptyTable" : "لا توجد بيانات في هذا الجدول",
						"sInfo" : "عرض _START_ الى _END_ من _TOTAL_ صفوف",
						"sInfoEmpty" : "عرض 0 الى 0 من 0 صفوف",
						"sInfoFiltered" : "(تصفية من _MAX_ مجموع صفوف)",
						"sInfoPostFix" :    "",
						"sInfoThousands" :  ",",
						"sLengthMenu" :     "عرض _MENU_ صفوف",
						"sLoadingRecords" : "تحميل ...",
						"sProcessing" :     "معالجة ...",
						"sSearch" :         "بحث:",
						"sZeroRecords" :    "لا توجد نتائج مطابقة",
						"oPaginate": {
							"sFirst" : "الاول",
							"sLast" : "الاخير",
							"sNext" : "التالي",
							"sPrevious" : "السابق",
						},
						"oAria": {
							"sSortAscending" :  " => تفعيل الترتيب تنازليا",
							"sSortDescending" : " => تفعيل الترتيب تصاعديا"
						}
					},
            });
        });
    </script>
    @endif

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- Bootstrap -->
    <script  src="{{ asset('dashboard') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script  src="{{ asset('dashboard') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script  src="{{ asset('dashboard') }}/dist/js/adminlte.js"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script  src="{{ asset('dashboard') }}/dist/js/demo.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('dashboard') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('dashboard') }}/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('dashboard') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ asset('dashboard') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('dashboard') }}/plugins/chart.js/Chart.min.js"></script>

    <!-- PAGE SCRIPTS -->
    {{-- <script src="{{ asset('dashboard/dist/js/pages/dashboard2.js') }}"></script> --}}



    @if(isset($modals))
        @for ($i = 0; $i < count($modals); $i++)
            @include('dashboard.modals.' . $modals[$i])
        @endfor
    @endif

    <!-- Logout Form -->
    <form id="logoutForm" action="{{ route('logout') }}" method="POST">@csrf @method('POST')</form>

    <!-- Sweet Alert 2 -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/sweetalert2/sweetalert2.min.css') }}">
    <script  src="{{ asset('dashboard/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script >
        $(function () {

            $(document).on('click', '.logout', function(e){
                e.preventDefault()
                let that = $(this);
                Swal.fire({
                    title: 'هل تريد المغادرة ؟ ',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'لا',
                    confirmButtonText: 'نعم',
                }).then((result) => {
                    if (result.value) {
                        if(that.data('callback')){
                            executeFunctionByName(that.data('callback'), window)
                        }
                        else if(that.data('form')){
                            $(that.data('form')).submit()
                        }
                        else{
                            $('form#logoutForm').submit()
                        }
                    }	
                })
            })

            @foreach (['success' => 'Success', 'error' => 'Error', 'warning' => 'Warning'] as $icon => $title)
                @if (session()->has($icon))
                    Swal.fire({
                        icon: '{{ $icon }}',
                        title: '{{ session()->get($icon) }}',
                        okButtonText: 'حسنا',
                    })
                @endif
            @endforeach
        });
    </script>



@stack('js')
</body>

</html>