    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="paymentModalLabel">اضافة دفعة</h4>
                </div>
                <form id="form_payment" action="{{ route('payments.store') }}" method="post">
                    @csrf 
                    <div class="modal-body">

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

$('.payment').click(function() {

	if($(this).hasClass("update")){
        $('#form_payment').attr('action', $(this).data('action'))
        $('#form_payment').append('<input type="hidden" name="_method" value="PUT">')
        $('.modal-title').text('تعديل شركة')
        //set data to inputs
    }else {
        $('#form_items').attr('action', '{{ route("companies.store") }}' )
        $('.modal-title').text('اضافة دفعة')
        $('#form_payment input[name="company_id"]').remove()
        $('#form_payment').append(`<input type="hidden" name="company_id" value="${$(this).data('company')}">`)
        
        //delete data from inputs
    }

            

})
</script>