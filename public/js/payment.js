let $saleHistoryPage = $('.sale-product-page');
let $tableSaleHistory = $('#table-sale-history');
let $modalForm = $saleHistoryPage.find('#payment-form');
let $orderId = $modalForm.find('#order_id');
let $orderCode = $modalForm.find('#order_code');
let $paymentMoney = $modalForm.find('#payment_money');
let $moneyLessThan = $modalForm.find('#money-less-than');

$(document).ready(function () {
    $saleHistoryPage.on('click', '.btn-payment', PaymentClass.payment);
    $saleHistoryPage.on('click', '.btn-payment-complete', PaymentClass.store);

});

let PaymentClass = {

    create: function() {
        PaymentClass.fillFormData();
        $modalForm.modal('show');
    },

    payment: function () {
        let id = $(this).data('id');
        let url = urlGetOrderById.replace(':id', id);
        let callApiToGetOrder =  PaymentClass.getOrderById(url);
        callApiToGetOrder.done(function (response) {
            if (response.error) {
                return swalError(response.error)
            }
            if (response.order) {
                let order = response.order;
                PaymentClass.fillFormData(order);
                $modalForm.modal('show');
            }
        })
    },
    store: function (e) {
        e.preventDefault();
        $(".error-message").text('')
        let dataInput = PaymentClass.getFormData();
        let callApiToStore = callApiWithFile(urlStorePayment, 'post', dataInput);
        callApiToStore.done(function(response){
            if (response.error) {
                return swalError(response.error)
            }
            return swalSuccess(response.success).then(() => {
                $tableSaleHistory.html(response.view)
                $modalForm.modal('hide');
            })
        }).fail(function (reject) {
            if (reject.status === 422) {
                var errors = $.parseJSON(reject.responseText).errors;
                console.log(errors)
                $.each(errors, function (key, val) {
                    if (key == 'payment_money') {
                        $('payment_money_error').removeClass('warning-text').addClass('error-text');
                    }
                });
            }
        })
    },
    fillFormData: function (order = {}) {
        $(".error-message").text('');
        $orderCode.text(order['order_code']);
        $orderId.val(order['id']);
        let debtMoney = order['debt_money'];
        $moneyLessThan.text(parseInt(debtMoney).toLocaleString());
        $("#payment_money").attr({ "max" : debtMoney});

    },
    getFormData: function () {
        let payment_money = '0';
        if ($('#payment_money').val()) {
            payment_money = $('#payment_money').val();
        }
        return {
            order_id: $('#order_id').val(),
            _token: _token,
            payment_money: parseFloat(payment_money.replace(/,/g, '')),
        }
    },
    getOrderById: function (url) {
        return  $.ajax({
            type: "GET",
            url: url,
        })
    },
}




