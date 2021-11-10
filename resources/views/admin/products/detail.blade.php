<div class="modal fade" id="product-detail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title">Product detail:</h4>
                </div>
                <div class="modal-body">
                    <div class="row modal-item">
                        <label class="label-title col-4">Image product: </label>
                        <div class="col-8">
                            <img style="width: 300px; height: 300px" class="image" src="" alt="">
                        </div>
                    </div>
                    <div class="row modal-item">
                        <label class="label-title col-4">Product code:</label>
                        <div class="col-8">
                            <span class="product_code"></span>
                        </div>
                    </div>
                    <div class="row modal-item">
                        <label class="label-title col-4">Product Name:</label>
                        <div class="col-8">
                            <span class="name"></span>
                        </div>
                    </div>
                    <div class="row modal-item">
                        <label class="label-title col-4">Status:</label>
                        <div class="status col-8" style="display: flex; flex-direction: row">
                            <div>
                                <input type="checkbox" class="available" disabled>
                                <span>Available</span>
                            </div>
                            <div class="ml-3">
                                <input type="checkbox" class="unavailable" disabled>
                                <span>Unavailable</span>
                            </div>
                            <div class="ml-3">
                                <input type="checkbox" class="suspended" disabled>
                                <span>Suspended</span>
                            </div>
                        </div>
                    </div>
                    <div class="row modal-item">
                        <label class="label-title col-4">Sale price:</label>
                        <div class="col-8">
                            <span class="sale_price"></span>
                        </div>
                    </div>
                    <div class="row modal-item">
                        <label class="label-title col-4">Quantity inventory:</label>
                        <div class="">
                            <span class="quantity_inventory col-8"></span>
                        </div>
                    </div>
                    <div class="row modal-item">
                        <label class="label-title col-4">Brand:</label>
                        <div class="">
                            <span class="brand col-8"></span>
                        </div>
                    </div>
                    <div class="row modal-item">
                        <label class="label-title col-4">Category:</label>
                        <div class="">
                            <span class="category col-8"></span>
                        </div>
                    </div>
                    <div class="row modal-item">
                        <label class="label-title col-4">Location</label>
                        <div class="">
                            <span class="location col-8"></span>
                        </div>
                    </div>
                    <div class="row modal-item">
                        <label class="label-title col-4">Description</label>
                        <div class="">
                            <span class="description col-8"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">{!! __('view.close') !!}</button>
                </div>
            </form>
        </div>
    </div>
</div>

