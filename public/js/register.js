var $createWareHouseForm = $("#createWareHouseForm");
var $createAccountForm = $("#createAccountForm");
var $progress = $("#progress");
var $warehouseName = $createWareHouseForm.find('#warehouse_name');
var $userName = $createAccountForm.find('#username');
var $fullName = $createAccountForm.find('#name');
var $email = $createAccountForm.find('#email');
var $phoneNumber = $createAccountForm.find('#phone_number');
var $password = $createAccountForm.find('#password');
var $passwordConfirm = $createAccountForm.find('#password_confirmation');


$(document).ready(function () {
    $(document).on('click', '#nextBtn', function () {
        $createWareHouseForm.css('left', '-450px');
        $createAccountForm.css('left', '40px');
        $progress.css('width', '360px');
    });
    $(document).on('click', '#backBtn', function () {
        $createWareHouseForm.css('left', '40px');
        $createAccountForm.css('left', '450px');
        $progress.css('width', '180px');
    });
    $(document).on('click', '#submitBtn', function () {
        $(".error-message").text('')
        let dataInput = WarehouseClass.getFormData();
        let callApiToStore = callApi(urlStoreWarehouse, 'post', dataInput);
        callApiToStore.done(function(response){
            if (response.error) {
                return swalError(response.error);
            }
            return swalSuccess(response.success).then(() => {
                window.location.href = urlLogin;
            })
        }).fail(function (reject) {
            if (reject.status === 422) {
                var errors = $.parseJSON(reject.responseText).errors;
                $.each(errors, function (key, val) {
                    $("#" + key + "_error").text(val[0]).removeClass('d-none');
                    if (key == 'warehouse_name') {
                        $createWareHouseForm.css('left', '40px');
                        $createAccountForm.css('left', '450px');
                        $progress.css('width', '180px');
                    }
                });
            }
        })
    });
});

let WarehouseClass = {

    getFormData: function () {
        return {
            _token: _token,
            warehouse_name: $warehouseName.val(),
            username: $userName.val(),
            name: $fullName.val(),
            phone_number: $phoneNumber.val(),
            email: $email.val(),
            password: $password.val(),
            password_confirmation: $passwordConfirm.val()
        }
    },

}
