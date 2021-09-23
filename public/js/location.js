let $locationPage = $('.location-page');
let $tableLocations = $('#tableLocations');
let $modalForm = $locationPage.find('#location-form');
let $locationId = $modalForm.find('#location_id');
let $locationName = $modalForm.find('#location_name');
let $locationDescription = $modalForm.find('#description');

$(document).ready(function () {
    $locationPage.on('click', '#createNew', locationClass.create);
    $locationPage.on('click', '.btn-edit', locationClass.edit);
    $locationPage.on('click', '.btn-save', locationClass.store);
    $locationPage.on('click', '.btn-update', locationClass.update);
    $locationPage.on('click', '.pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        locationClass.getPage(page)
    })
});

let locationClass = {

    create: function() {
        locationClass.fillFormData();
        $modalForm.modal('show');
    },

    edit: function () {
        let id = $(this).closest('tr').attr('data-id');
        let url = urlEditLocation.replace(':id', id);
        let callApiToGetLocation =  locationClass.getLocationById(url, id);
        callApiToGetLocation.done(function (response) {
            if (response.error) {
                return swalError(response.error)
            }
            if (response.location) {
                let location = response.location;
                locationClass.fillFormData(location);
                $modalForm.modal('show');
            }
        })
    },
    store: function (e) {
        e.preventDefault();
        $(".error-message").text('')
        let dataInput = locationClass.getFormData();
        let callApiToStore = callApi(urlStoreLocation, 'post', dataInput);
        callApiToStore.done(function(response){
            if (response.error) {
                return swalError(response.error)
            }
            return swalSuccess(response.success).then(() => {
                $tableLocations.html(response.view)
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
        let dataInput = locationClass.getFormData();
        let callApiToStore = callApi(urlUpdateLocation, 'patch', dataInput);
        callApiToStore.done(function(response){
            if (response.error)
            {
                return swalError(response.error)
            }
            if (response.success) {
                return swalSuccess(response.success).then(() => {
                    $tableLocations.html(response.view)
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

    fillFormData: function (location = {}) {
        $(".error-message").text('');
        $locationName.val(location['location_name'] || '');
        $locationDescription.val(location['description' || '']);
        $locationId.val(location['id'] || '');
        if (location['id']) {
            $modalForm.find('.modal-title').text(lblEdit);
            $modalForm.find('.btn-action').text(lblUpdate).addClass('btn-update').removeClass('btn-save');
        } else {
            $modalForm.find('.modal-title').text(lblCreate);
            $modalForm.find('.btn-action').text(lblSave).addClass('btn-save').removeClass('btn-update');
        }
    },
    getFormData: function () {
        return {
            id: $locationId.val(),
            _token: _token,
            location_name: $locationName.val(),
            description: $locationDescription.val(),
        }
    },
    getPage: function (page) {
        $.ajax({
            type: "GET",
            url: '?page='+ page
        }).done(function (response) {
            history.pushState(null, null, '?page=' + page);
            $tableLocations.html(response.view)
        })
    },
    getLocationById: function (url, id) {
        return  $.ajax({
            type: "GET",
            url: url,
        })
    },
}


