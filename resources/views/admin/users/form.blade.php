
<div class="modal fade" role="dialog" id="user-form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="user_id">
                    <input type="hidden" id="user_key">
                    <div class="form-group">
                        <label for="link"> User name<em class="required">*</em></label>
                        <div>
                            <input class="form-control" id="user_name" name="user_name">
                        </div>
                        <div class="text-danger d-none error-message" id="user_name_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="name">Full name<em class="required">*</em></label>
                        <div>
                            <input class="form-control" id="name" name="name">
                        </div>
                        <div class="text-danger d-none error-message" id="name_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone number</label>
                        <div>
                            <input type="text" class="form-control" id="phone_number" name="phone_number">
                        </div>
                        <div class="text-danger d-none error-message" id="phone_number_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email<em class="required">*</em></label>
                        <div>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="text-danger d-none error-message" id="email_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Role<em class="required">*</em></label>
                        <div>
                            <select class="form-control" id="role_id" name="role_id">
                                @foreach ($roleOptions as $key => $value)
                                    <option value="{!! $key !!}">{!! $value !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-danger d-none error-message" id="role_id_error"></div>
                    </div>
                    <div class="form-group">
                        <label for="is_active">Active status <em class="required">*</em></label>
                        <div>
                            <select class="form-control" id="is_active" name="is_active">
                                @foreach ($activeOptions as $key => $value)
                                    <option value="{!! $key !!}">{!! $value !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-danger d-none error-message" id="is_active_error"></div>
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
