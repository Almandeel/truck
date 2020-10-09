    <!-- Modal -->
    <div class="modal fade" id="pricingModal" tabindex="-1" role="dialog" aria-labelledby="pricingModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="pricingModalLabel">اضافة تسعيرة</h4>
                </div>
                <form id="form_pricing" action="{{ route('pricings.store') }}" method="post">
                    @csrf 
                    <div class="modal-body">

                        <div class="form-group">
                            <label>الاسم</label>
                            <input type="text" class="form-control" name="name" placeholder="الاسم" required>
                        </div>

                        <div class="form-group">
                            <label>القيمة</label>
                            <input type="text" class="form-control" name="amount" placeholder="القيمة" required>
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

$('.pricing').click(function() {

	if($(this).hasClass("update")){
        $('#form_pricing').attr('action', $(this).data('action'))
        $('#form_pricing').append('<input type="hidden" name="_method" value="PUT">')

        $('.modal-title').text('تعديل تسعيرة')

        //set data to inputs
        $('#form_pricing input[name="name"]').val($(this).data('name'))
        $('#form_pricing input[name="amount"]').val($(this).data('amount'))

    }else {
        $('#form_items').attr('action', '{{ route("pricings.store") }}' )
        $('.modal-title').text('اضافة تسعيرة')
        
        //delete data from inputs
        $('#form_pricing input[name="name"]').val('')
        $('#form_pricing input[name="amount"]').val('')
    }

            

})
</script>