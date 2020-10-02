    <!-- Modal -->
    <div class="modal fade" id="TenderyModal" tabindex="-1" role="dialog" aria-labelledby="tenderModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="tenderModalLabel">اضف عرضك</h4>
                </div>
                <form id="form_unit" action="{{ route('orders.update', $order->id) }}?type=tender" method="post">
                    @csrf 
                    @method('PUT')
                    <div class="modal-body">

                        <div class="form-group">
                            <label>السعر</label>
                            <input type="number" class="form-control" name="price" placeholder="السعر" required>
                        </div>

                        <div class="form-group">
                            <label>مدة الشحن</label>
                            <input type="number" class="form-control" name="duration" placeholder="مدة الشحن" required>
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