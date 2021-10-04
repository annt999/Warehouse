let $changePasswordForm = $('.change-password-form');
let $forgetPasswordForm = $('.forget-password-form');
let $resetPasswordForm = $('.reset-password-form');


$(document).ready(function () {
    $changePasswordForm.on('click', '.btn-change-password', ChangePasswordClass.submit);
    $forgetPasswordForm.on('click', '.btn-forget-password', ForgetPasswordClass.submit);
    $resetPasswordForm.on('click', '.btn-reset-password', ResetPasswordClass.submit);

})

let ChangePasswordClass = {
    submit: function (e) {
        e.preventDefault();
        $(".error-message").text('')
        let urlChangePassword = $changePasswordForm.attr('action');
        let dataInput = $changePasswordForm.serialize();
        let callApiToChangePassword = callApi(urlChangePassword, 'post', dataInput);
        callApiToChangePassword.done(function (response) {
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
                });
            }
        })
    }
};

let ForgetPasswordClass = {
    submit: function (e) {
        e.preventDefault();
        console.log(123)
        $(".error-message").text('')
        let urlForgotPassword = $forgetPasswordForm.attr('action');
        let dataInput = $forgetPasswordForm.serialize();
        let callApiToForgotPassword = callApi(urlForgotPassword, 'post', dataInput);
        callApiToForgotPassword.done(function (response) {
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
                });
            }
        })

    }
}
let ResetPasswordClass = {
    submit: function (e) {
        e.preventDefault();
        $(".error-message").text('')
        let urlResetPassword = $resetPasswordForm.attr('action');
        let dataInput = $resetPasswordForm.serialize();
        let callApiToResetPassword = callApi(urlResetPassword, 'post', dataInput);
        callApiToResetPassword.done(function (response) {
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
                });
            }
        })

    }
}
