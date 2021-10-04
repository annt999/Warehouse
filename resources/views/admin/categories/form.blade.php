<div class="modal fade" role="dialog" id="category-form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="category_id">
                    <input type="hidden" id="category_key">
                    <div class="form-group">
                        <label for="link"> Category name<em class="required">*</em></label>
                        <div>
                            <input class="form-control" id="name" name="name">
                        </div>
                        <div class="text-danger d-none error-message" id="name_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="level_id">Level<em class="required">*</em></label>
                        <div>
                            <select class="form-control" id="category_level" name="level">
                                @foreach ($levelOptions as $key => $value)
                                    <option value="{!! $key !!}">{!! $value !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-danger d-none error-message" id="category_level_error"></div>
                    </div>
                    <div class="form-group category_fathers_wrap">
                        <label for="level_id">Category father<em class="required">*</em></label>
                        <div>
                            <select class="form-control" id="parent_id" name="parent_id">
                                @foreach ($categoryFatherOptions as $category)
                                    <option value="{!! $category->id !!}">{!! $category->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-danger d-none error-message" id="parent_id_error"></div>
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
