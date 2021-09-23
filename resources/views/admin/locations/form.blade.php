<div class="modal fade" role="dialog" id="location-form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="location_id">
                    <input type="hidden" id="location_key">
                    <div class="form-group">
                        <label for="link"> Location name<em class="required">*</em></label>
                        <div>
                            <input class="form-control" id="location_name" name="location_name">
                        </div>
                        <div class="text-danger d-none error-message" id="location_name_error"></div>
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
