	<!-- Main Footer -->
		<footer class="main-footer">
			<!-- To the right -->
			<div class="float-right d-none d-sm-inline">
				Anything you want
			</div>
			Default to the left
			<strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
		</footer>
	</div>
	<!-- ./wrapper -->
	
	<!-- REQUIRED SCRIPTS -->

	<!-- Bootstrap 4 -->
	<script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('dashboard/js/adminlte.min.js') }}"></script>
	<!-- Logout Form -->
	<form id="logoutForm" action="{{ route('logout') }}" method="POST">@csrf @method('POST')</form>

	@if(isset($datatable))
		<!-- DataTables -->
		<link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.css') }}">

		<!-- DataTables -->
		<script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.js') }}"></script>
		<script src="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
		<script>
			$.extend( true, $.fn.dataTable.defaults, {
				'paging'      : true,
				'lengthChange': true,
				'searching'   : true,
				'ordering'    : true,
				'info'        : true,
				'autoWidth'   : true,
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
				'dom': 'Bfrtip',
				buttons: [
					{
						extend: 'print',
						text: 'طباعة المحتوى'
					},
					{
						extend: 'excel',
						text: 'تصدير Excel'
					},
				]
			} );
			$(function(){
				if (!$.fn.DataTable.isDataTable( 'table.datatable' ) ) {
					$('table.datatable').dataTable();
				}
			})
		</script>
	@endif

	@if(isset($modals))
		@foreach ($modals as $modal)
			@include('modals.' . $modal)
		@endforeach
	@endif

	@if(!isset($noForm))
		<!-- Parsley -->
		<script src="{{ asset('dashboard/plugins/parsleyjs/parsley.js')}}"></script>
		<script src="{{ asset('dashboard/plugins/parsleyjs/i18n/ar.js')}}"></script>
		<script src="{{ asset('dashboard/js/snippts.js')}}"></script>
		
		<link href="{{ asset('dashboard/plugins/jquery-editable-select/dist/jquery-editable-select.min.css') }}" rel="stylesheet">
		<script src="{{ asset('dashboard/plugins/jquery-editable-select/dist/jquery-editable-select.min.js') }}"></script>
		<script>
			$(function(){
				$('select.editable').editableSelect();

				$('form').parsley();
		
				window.Parsley.on('form:success', function(){
					$('button[type="submit"]').attr('disabled', true)
				})

				
				setCounter($('.table-attachments'));
				$('.table-attachments .btn-add').on('click', function(event){
					// if(!event.detail || event.detail == 1){}
					let tbody = $(this).parent().parent().parent().siblings('tbody');
					let row = `
					<tr>
						<td>`+(tbody.children().length + 1)+`</td>
						<td>
							<input type="text" class="form-control attachment-name" placeholder="Name" name="attachments_names[]" required>
						</td>
						<td>
							<input type="file" class="form-control attachment-file" placeholder="Name" name="attachments_files[]" required>
						</td>
						<td>
							<button type="button" class="btn btn-danger btn-xs btn-remove">
								<i class="fa fa-trash"></i>
								<span class="d-none d-md-inline">حذف</span>
							</button>
						</td>
					</tr>
					`;
					if(tbody.children().length > 0) {
						let attachmentName = $(tbody.children().last()[0]).find('input.attachment-name');
						let attachmentFile = $(tbody.children().last()[0]).find('input.attachment-file');
						// if(attachmentName.val() && attachmentFile.val()){
							tbody.append(row);
						// }
					}else{
						$(row).appendTo(tbody);
					}
				})
				$('.table-attachments').on('click', '.btn-remove', function(){
					if(confirm('حذف المرفق متابعه؟')){
						let table = $(this).parent().parent().parent().parent();
						$(this).parent().parent().remove()
						setCounter(table)
					}
				})
			});
				
			function setCounter(table){
				let rows = table.children('tbody').find('tr');
				for( let i = 0; i < rows.length; i++){ $(rows[i]).children('td:nth-child(1)').text(i+1) } 
			}
		</script>
	@endif
	@if(isset($external_office_modals))
		@foreach ($external_office_modals as $modal)
			@include('externaloffice::modals.' . $modal)
		@endforeach
	@endif
	@if (isset($lightbox))
		<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/plugins/ekko-lightbox/ekko-lightbox.css') }}"/>
		<script src="{{ asset('dashboard/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
		<script>
			$(function () {
				$(document).on('click', '[data-toggle="lightbox"]', function(event) {
					event.preventDefault();
					$(this).ekkoLightbox({
						alwaysShowClose: true
					});
				});
			});
		</script>
	@endif
	<!-- Sweet Alert 2 -->
	<script src="{{ asset('dashboard/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
	<script>
		$(function(){
			$(document).on('click', '.logout', function(e){
				e.preventDefault()
				let that = $(this);
				Swal.fire({
					title: 'Do You wont Logout ?',
					text: "Do You wont Logout",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					cancelButtonText: 'Cancel',
					confirmButtonText: 'Yes',
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

			@foreach (['success' => 'تم بنجاح', 'error' => 'حدث خطأ', 'warning' => 'تحذير'] as $icon => $title)
				@if (session()->has($icon))
					Swal.fire({
						icon: '{{ $icon }}',
						title: '{{ $title }}',
						text: '{{ session()->get($icon) }}',
						okButtonText: 'حسنا',
					})
				@endif
			@endforeach
		})
	</script>
	@stack('foot')
</body>

</html>
