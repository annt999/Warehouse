<div class="modal fade payment-form" role="dialog" id="payment-form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title">Payment order</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label style="padding-right: 50px; width: 200px">Order code: </label>
                        <span id="order_code"></span>
                    </div>
                    <input type="text" id="order_id" hidden>
                    <div class="form-group">
                        <label style="padding-right: 50px; width: 200px">Payment money :</label>
                        <div style="display: inline-block">
                            <input type="text" id="payment_money" class="form-control money" value="0">
                        </div>
                        <div style="margin-left: 205px;" class="warning-text" id="payment_money_error">Enter an amount less than or equal to <span class="warning-text" id="money-less-than"></span></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">{!! __('view.close') !!}</button>
                    <button class="btn btn-primary btn-payment-complete">Complete</button>
                </div>
            </form>

        </div>
    </div>
</div>
