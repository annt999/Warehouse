<div class="modal fade" role="dialog" id="product-search-form">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="formProduct">
                <div class="modal-header">
                    <h4 class="modal-title" style="color: black"> Search product</h4>
                </div>
                <div class="modal-body">
                    <div class="form-wrap" style="display: flex; justify-content: space-between">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <div>
                                            <input class="form-control" name="name" id="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Product code</label>
                                        <div>
                                            <input class="form-control" name="product_code" id="product_code">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px">
                                <div class="col">
                                    <label for="status">Status</label>
                                    <div>
                                        <select class="custom-select" name="status" id="status">
                                            <option value="" selected></option>
                                            @foreach($productStatusOptions as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="brand_id">Brand</label>
                                    <div>
                                        <select class="custom-select" name="brand_id" id="brand_id">
                                            <option value="" selected></option>
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px">
                                <div class="col">
                                    <label>Category father</label>
                                    <select class="custom-select" id="category_father_id">
                                        <option value="" selected></option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Category child</label>
                                    <select class="custom-select" name="category_child_id" id="category_child_id">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px">
                                <div class="col-6">
                                    <label for="quantity">Quantity inventory</label>
                                    <div class="" style="display: flex; flex-direction: row">
                                        <input class="form-control" id="quantity_min" name="quantity_inventory_min" placeholder="min"
                                               onkeypress="return isNumber(event)" onpaste="return false;" style="width: 40%; margin-right: 20px">
                                        <span>-</span>
                                        <input class="form-control" id="quantity_max" name="quantity_inventory_max" placeholder="max"
                                               onkeypress="return isNumber(event)" onpaste="return false;" style="width: 40%; margin-left: 20px">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-create" data-dismiss="modal">{!! __('view.close') !!}</button>
                    <button class="btn btn-primary btn-search">Search</button>
                </div>
            </form>

        </div>
    </div>
</div>
