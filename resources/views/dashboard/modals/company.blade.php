    <!-- Modal -->
    <div class="modal fade" id="CompanyModal" tabindex="-1" role="dialog" aria-labelledby="CompanyModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="CompanyModalLabel">اضافة شركة</h4>
                </div>
                <form id="form_unit" action="{{ route('companies.store') }}" method="post">
                    @csrf 
                    <div class="modal-body">

                        <div class="form-group">
                            <label>الاسم</label>
                            <input type="text" class="form-control" name="name" placeholder="الاسم" required>
                        </div>

                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="number" class="form-control" name="phone" placeholder="رقم الهاتف" required>
                        </div>

                        <div class="form-group">
                            <label>العنوان</label>
                            <input type="text" class="form-control" name="address" placeholder="العنوان" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<script>

$('.company').click(function() {

	if($(this).hasClass("update")){
        $('#form_unit').attr('action', $(this).data('action'))
        $('#form_unit').append('<input type="hidden" name="_method" value="PUT">')

        $('.modal-title').text('تعديل شركة')

        //set data to inputs
        $('#form_unit input[name="name"]').val($(this).data('name'))
        $('#form_unit input[name="phone"]').val($(this).data('phone'))
        $('#form_unit input[name="address"]').val($(this).data('address'))

    }else {
        $('#form_items').attr('action', '{{ route("companies.store") }}' )
        $('.modal-title').text('اضافة شركة')
        
        //delete data from inputs
        $('#form_unit input[name="name"]').val('')
        $('#form_unit input[name="phone"]').val('')
        $('#form_unit input[name="address"]').val('')
    }

            

})
</script>