<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ config('app.name')  }} @if (isset($title))| {{ $title }} @endif</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- jQuery -->
  <script src="{{ asset('dashboard/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dashboard/css/adminlte.min.css') }}">
  @if(!isset($ltr))
  <!-- RTL -->
  <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap-rtl.css') }}">
  <style>
    table.table-bordered.dataTable th:first-child,
    table.table-bordered.dataTable td:first-child {
    border-left-width: 0px !important;
    border-right-width: 0px !important;
    }
    
    table.table-bordered.dataTable th:last-child,
    table.table-bordered.dataTable td:last-child {
    border-right-width: 1px !important;
    border-left-width: 0px !important;
    }
  </style>
  @else
  <style>
    table.table-bordered.dataTable th:last-child,
    table.table-bordered.dataTable td:last-child {
      border-left-width: 1px !important;
      border-right-width: 0px !important;
    }
  
    table.table-bordered.dataTable th:first-child,
    table.table-bordered.dataTable td:first-child {
      border-right-width: 0px !important;
      border-left-width: 0px !important;
    }
  </style>
  @endif
   <!-- Theme style --> 
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/sweetalert2/sweetalert2.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/parsleyjs/parsley.min.css') }}">

    <script>
		$(document).on('click', '.delete', function(e){
			e.preventDefault()
			let that = $(this);
			Swal.fire({
				title: 'هل انت متأكد؟',
				text: "سوف يتم الحذف",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'إلغاء',
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
						that.closest('form').submit()
					}
				}	
			})
		})
	</script>
  @stack('head')
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
