<div class="modal fade" id="user-detail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title">{!! __('view.user_page.user_detail') !!}</h4>
                </div>
                <div class="modal-body">
                    <div class="row ">
                        <label class="col-md-4">{!! __('view.user_page.user_name') !!}:</label>
                        <div class="col-md-8">
                            <span class="username"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-4">{!! __('view.user_page.name') !!}:</label>
                        <div class="col-md-8">
                            <span class="name"></span>
                        </div>
                    </div>
                    <div class="row ">
                        <label class="col-md-4">{!! __('view.user_page.email') !!}:</label>
                        <div class="col-md-8">
                            <span class="email"></span>
                        </div>
                    </div>
                    <div class="row ">
                        <label class="col-md-4">{!! __('view.user_page.phone_number') !!}:</label>
                        <div class="col-md-8">
                            <span class="phone_number"></span>
                        </div>
                    </div>
                    <div class="row ">
                        <label class="col-md-4">{!! __('view.user_page.status') !!}:</label>
                        <div class="col-md-8 is-active d-flex">
                            <div>
                                <input type="checkbox" class="active" disabled>
                                <span>{!! __('view.user_page.active') !!}</span>
                            </div>
                            <div class="ml-3">
                                <input type="checkbox" class="disabled" disabled>
                                <span>{!! __('view.user_page.disable') !!}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <label class="col-md-4">{!! __('view.user_page.role') !!}:</label>
                        <div class="col-md-8">
                            <span class="role"></span>
                        </div>
                    </div>
                    <div class="row ">
                        <label class="col-md-4">{!! __('view.user_page.created_at') !!}:</label>
                        <div class="col-md-8">
                            <span class="created_at"></span>
                        </div>
                    </div>
                    <div class="row ">
                        <label class="col-md-4">{!! __('view.user_page.updated_at') !!}:</label>
                        <div class="col-md-8">
                            <span class="updated_at"></span>
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
