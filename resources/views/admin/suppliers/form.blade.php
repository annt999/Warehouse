<div class="modal fade" role="dialog" id="supplier-form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="supplier_id">
                    <input type="hidden" id="supplier_key">
                    <div class="form-group">
                        <label for="link"> Supplier name<em class="required">*</em></label>
                        <div>
                            <input class="form-control" id="name" name="name">
                        </div>
                        <div class="text-danger d-none error-message" id="name_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="link"> Supplier phone</label>
                        <div>
                            <input class="form-control" id="supplier_phone" name="supplier_phone">
                        </div>
                        <div class="text-danger d-none error-message" id="phone_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <div>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="text-danger d-none error-message" id="description_error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-create" data-dismiss="modal">{!! __('view.close') !!}</button>
                    <button class="btn btn-primary btn-action"></button>
                </div>
            </form>

        </div>
    </div>
</div>
