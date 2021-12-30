let $userPage = $('.user-page');
let $tableUsers = $('#tableUsers');
let $modalForm = $userPage.find('#user-form');
let $modalDetail = $userPage.find('#user-detail');
let $userId = $modalForm.find('#user_id');
let $userName = $modalForm.find('#username');
let $name = $modalForm.find('#name');
let $isActive = $modalForm.find('#is_active');
let $phoneNumber = $modalForm.find('#phone_number');
let $email = $modalForm.find('#email');
let $roleId = $modalForm.find('#role_id');

$(document).ready(function () {
    $userPage.on('click', '#createNew', UserClass.create);
    $userPage.on('click', '.btn-edit', UserClass.edit);
    $userPage.on('click', '.btn-detail', UserClass.show);
    $userPage.on('click', '.btn-save', UserClass.store);
    $userPage.on('click', '.btn-update', UserClass.update);
    $userPage.on('click', '.pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        UserClass.getPage(page)
    })
});

let UserClass = {

    create: function() {
        UserClass.fillFormData();
        $userName.prop('disabled', false);
        $email.prop('disabled', false);
        $modalForm.modal('show');
    },

    edit: function () {
        let id = $(this).closest('tr').attr('data-id');
        let url = urlEditUser.replace(':id', id);
        let callApiToGetUser =  UserClass.getUserById(url, id);
        callApiToGetUser.done(function (response) {
            if (response.error) {
                return swalError(response.error)
            }
            if (response.user) {
                let user = response.user;
                UserClass.fillFormData(user);
                $userName.prop('disabled', true);
                $email.prop('disabled', true);
                $modalForm.modal('show');
            }
        })
    },
    show: function () {
        let id = $(this).closest('tr').attr('data-id');
        let url = urlDetailUser.replace(':id', id);
        let callApiToShowUser =  UserClass.getUserById(url, id);
        callApiToShowUser.done(function (response) {
            if (response.error) {
                return swalError(response.error)
            }
            if (response.user) {
                let user = response.user;
                $modalDetail.find('.username').text(user['username']);
                $modalDetail.find('.name').text(user['name']);
                $modalDetail.find('.email').text(user['email']);
                $modalDetail.find('.phone_number').text(user['phone_number']);
                $modalDetail.find('.active, .disabled').prop('checked', false);
                $modalDetail.find(user['is_active'] === active ? '.active' : '.disabled').prop('checked', true);
                $modalDetail.find('.role').text(user['role']);
                $modalDetail.find('.created_at').text(user['created_time']);
                $modalDetail.find('.updated_at').text(user['updated_time'] ? user['updated_time'] : '');
                $modalDetail.modal('show');
            }
        })
    },
    store: function (e) {
        e.preventDefault();
        $(".error-message").text('');
        let dataInput = UserClass.getFormData();
        let callApiToStore = callApi(urlStoreUser, 'post', dataInput);
        callApiToStore.done(function(response){
            if (response.error) {
                return swalError(response.error)
            }
            return swalSuccess(response.success).then(() => {
                $tableUsers.html(response.view);
                $modalForm.modal('hide');
            })
        }).fail(function (reject) {
            if (reject.status === 422) {
                var errors = $.parseJSON(reject.responseText).errors;
                $.each(errors, function (key, val) {
                    $("#" + key + "_error").text(val[0]).removeClass('d-none');
                });
            }
        })
    },
    update: function (e) {
      e.preventDefault();
        $(".error-message").text('')
        let dataInput = UserClass.getFormData();
        let callApiToStore = callApi(urlUpdateUser, 'post', dataInput);
        callApiToStore.done(function(response){
            if (response.error)
            {
                return swalError(response.error)
            }
            if (response.success) {
                return swalSuccess(response.success).then(() => {
                    $tableUsers.html(response.view)
                    $modalForm.modal('hide');
                })
            }
        }).fail(function (reject) {
            $(".error-message").text('');
            if (reject.status === 422) {
                var errors = $.parseJSON(reject.responseText).errors;
                $.each(errors, function (key, val) {
                    $("#" + key + "_error").text(val[0]).removeClass('d-none');
                });
            }
        })

    },

    fillFormData: function (user = {}) {
        $(".error-message").text('')
        $userName.val(user['username'] || '');
        $name.val(user['name'] || '');
        $isActive.val(user['is_active'] || active);
        $phoneNumber.val(user['phone_number'] || '');
        $email.val(user['email'] || '');
        $userId.val(user['id'] || '');
        $roleId.val(user['role_id' || '']);
        if (user['id']) {
            $modalForm.find('.modal-title').text(lblEdit);
            $modalForm.find('.btn-action').text(lblUpdate).addClass('btn-update').removeClass('btn-save');
        } else {
            $modalForm.find('.modal-title').text(lblCreate);
            $modalForm.find('.btn-action').text(lblSave).addClass('btn-save').removeClass('btn-update');
        }
    },
    getFormData: function () {
        return {
            id: $userId.val(),
            _token: _token,
            username: $userName.val(),
            name: $name.val(),
            phone_number: $phoneNumber.val(),
            email: $email.val(),
            is_active: $isActive.val(),
            role_id: $roleId.val()
        }
    },
    getPage: function (page) {
        $.ajax({
            type: "GET",
            url: '?page='+ page
        }).done(function (response) {
            history.pushState(null, null, '?page=' + page);
            $tableUsers.html(response.view)
        })
    },
    getUserById: function (url, id) {
        return  $.ajax({
            type: "GET",
            url: url,
        })
    }
}


