<div class="modal fade" role="dialog" id="product-form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="product_id">
                    <input type="hidden" id="product_key">
                    <div class="form-group">
                        <label for="image">Image <em class="required">*</em></label>
                        <div>
                            <input type="file" name="image" class="form-control" id="image" accept="image/*">
                            <div class="image-container"></div>
                        </div>
                        <div class="text-danger d-none error-message" id="image_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="name">Name<em class="required">*</em></label>
                        <div>
                            <input class="form-control" id="name" name="name">
                        </div>
                        <div class="text-danger d-none error-message" id="name_error"></div>
                    </div>

                    <div class="form-group">
                        <label for="location_id">Location<em class="required">*</em></label>
                        <div>
                            <input class="form-control" id="name" name="location_id">
                        </div>
                        <div class="text-danger d-none error-message" id="location_id_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="brand_id">Brand<em class="required">*</em></label>
                        <div>
                            <input class="form-control" id="name" name="brand_id">
                        </div>
                        <div class="text-danger d-none error-message" id="brand_id_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category<em class="required">*</em></label>
                        <div>
                            <input class="form-control" id="name" name="category_id">
                        </div>
                        <div class="text-danger d-none error-message" id="category_id_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="is_trading">Is trading<em class="required">*</em></label>
                        <div>
                            <input class="form-control" id="name" name="is_trading">
                        </div>
                        <div class="text-danger d-none error-message" id="is_trading_error"></div>
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
