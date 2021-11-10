<div class="modal fade" role="dialog" id="product-form">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="formProduct">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="product_id">
                    <input type="hidden" id="product_key">
                    <div class="form-wrap" style="display: flex; justify-content: space-between">
                        <div class="form-left" style="width: 40%">
                            <div class="form-group">
                                <label for="image">Image <em class="required">*</em></label>
                                <div>
                                    <input type="file" name="image" class="form-control" id="image" accept="image/*">
                                    <div class="image-container" style="padding: 10px"></div>
                                </div>
                                <div class="text-danger d-none error-message" id="extension_error"></div>
                            </div>
                            <div class="form-group">
                                <label for="name">Name<em class="required">*</em></label>
                                <div>
                                    <input class="form-control" id="name" name="name">
                                </div>
                                <div class="text-danger d-none error-message" id="name_error"></div>
                            </div>
                        </div>

                        <div class="form-right" style="width: 55%">
                            <div class="form-group" style="display: flex; justify-content: space-between">
                                <div style="width: 50%">
                                    <label for="location_id">Location<em class="required">*</em></label>
                                    <div>
                                        <select class="custom-select" id="location_id">
                                            <option value="" selected></option>
                                            @foreach($locations as $location)
                                                <option value="{{$location->id}}">{{$location->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-danger d-none error-message" id="location_id_error"></div>
                                </div>
                                <div style="width: 45%">
                                    <label for="brand_id">Brand<em class="required">*</em></label>
                                    <div>
                                        <select class="custom-select" id="brand_id">
                                            <option value="" selected></option>
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-danger d-none error-message" id="brand_id_error"></div>
                                </div>
                            </div>
                            <div class="category_wrap form-group" style="width: 100%; display: inline-flex; justify-content: space-between">
                                <div class="category_father" style="width: 50%">
                                    <label>Category father<em class="required">*</em></label>
                                    <select class="custom-select" id="category_father">
                                        <option value="" selected></option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="category_child" style="width: 45%">
                                    <label>Category child<em class="required">*</em></label>
                                    <select class="custom-select" id="category_id">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-danger d-none error-message" id="category_id_error"></div>
                            <div class="form-group" style="display: flex; justify-content: space-between">
                                <div style="width: 50%">
                                    <label for="status">Status<em class="required">*</em></label>
                                    <div>
                                        <select class="custom-select" id="status">
                                            <option value="" selected></option>
                                            @foreach($productStatusOptions as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-danger d-none error-message" id="status_error"></div>
                                </div>
                                <div style="width: 45%">
                                    <label for="name">Sale price</label>
                                    <div>
                                        <input class="form-control money" id="sale_price" name="sale_price">
                                    </div>
                                    <div class="text-danger d-none error-message" id="sale_price_error"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <div>
                                    <textarea rows="5" type="text" class="form-control" id="description" name="description">
                                    </textarea>
                                </div>
                                <div class="text-danger d-none error-message" id="description_error"></div>
                            </div>
                        </div>
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
