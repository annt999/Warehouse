<div class="modal fade" role="dialog" id="customer-form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="customer_id">
                    <input type="hidden" id="customer_key">
                    <div class="form-group">
                        <label>Customer name<em class="required">*</em></label>
                        <div>
                            <input class="form-control" id="name" name="name">
                        </div>
                        <div class="text-danger d-none error-message" id="name_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone<em class="required">*</em></label>
                        <div>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="text-danger d-none error-message" id="phone_number_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <div>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="text-danger d-none error-message" id="address"></div>
                    </div>
                    <div class="form-group">
                        <label for="description">Email<em class="required">*</em></label>
                        <div>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="text-danger d-none error-message" id="email_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="description">Gender<em class="required">*</em></label>
                        <div>
                            <select class="form-control" id="gender" name="gender">
                                <option value="" selected></option>
                                @foreach ($genderOptions as $key => $value)
                                    <option value="{!! $key !!}">{!! $value !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-danger d-none error-message" id="gender_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <div>
                            <input class="datepicker form-control"  id="birthday">
                        </div>
                        <div class="text-danger d-none error-message" id="birthday_error"></div>
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
