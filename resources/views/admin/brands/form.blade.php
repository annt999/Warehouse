<div class="modal fade" role="dialog" id="brand-form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="brand_id">
                    <input type="hidden" id="brand_key">
                    <div class="form-group">
                        <label for="link"> Brand name<em class="required">*</em></label>
                        <div>
                            <input class="form-control" id="brand_name" name="name">
                        </div>
                        <div class="text-danger d-none error-message" id="name_error"></div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <div>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="text-danger d-none error-message" id="description_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="image">{!! __('view.brand_page.brand_logo') !!} <em class="required">*</em></label>
                        <div>
                            <input type="file" name="image" class="form-control" id="image" accept="image/*">
                            <div class="image-container"></div>
                        </div>
                        <div class="text-danger d-none error-message" id="image_error"></div>
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
