    <!-- Modal -->
    <div class="modal fade" id="zoneModal" tabindex="-1" role="dialog" aria-labelledby="zoneModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="zoneModalLabel">اضافة وحدة</h4>
                </div>
                <form id="form_unit" action="{{ route('zones.store') }}" method="post">
                    @csrf 
                    <div class="modal-body">

                        <div class="form-group">
                            <label>الاسم</label>
                            <input type="text" class="form-control" name="name" placeholder="الاسم" required>
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

$('.zone').click(function() {

	if($(this).hasClass("update")){
        $('#form_unit').attr('action', $(this).data('action'))
        $('#form_unit').append('<input type="hidden" name="_method" value="PUT">')

        $('.modal-title').text('تعديل منطقة')

        //set data to inputs
        $('#form_unit input[name="name"]').val($(this).data('name'))

    }else {
        $('#form_items').attr('action', '{{ route("zones.store") }}' )
        $('.modal-title').text('اضافة منطقة')
        
        //delete data from inputs
        $('#form_unit input[name="name"]').val('')
    }

            

})
</script>