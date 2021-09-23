let $categoryPage = $('.category-page');
let $tableCategories = $('#tableCategories');
let $modalForm = $categoryPage.find('#category-form');
let $categoryId = $modalForm.find('#category_id');
let $categoryName = $modalForm.find('#category_name');
let $categoryLevel = $modalForm.find('#category_level');
let $categoryFather = $modalForm.find('#category_father');
let $categoryFatherWrap = $modalForm.find('.category_fathers_wrap');

$(document).ready(function () {
    $categoryPage.on('click', '#createNew', CategoryClass.create);
    $categoryPage.on('click', '.btn-edit', CategoryClass.edit);
    $categoryPage.on('click', '.btn-save', CategoryClass.store);
    $categoryPage.on('click', '.btn-update', CategoryClass.update);
    $categoryPage.on('change', '#category_level', CategoryClass.showCategoryFatherOptions)
    $categoryPage.on('click', '.pagination a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        CategoryClass.getPage(page)
    })
});

let CategoryClass = {

    create: function() {
        CategoryClass.fillFormData();
        $modalForm.modal('show');
    },

    edit: function () {
        let id = $(this).closest('tr').attr('data-id');
        let url = urlEditCategory.replace(':id', id);
        let callApiToGetCategory =  CategoryClass.getCategoryById(url, id);
        callApiToGetCategory.done(function (response) {
            if (response.error) {
                return swalError(response.error)
            }
            if (response.category) {
                let category = response.category;
                CategoryClass.fillFormData(category);
                $modalForm.modal('show');
            }
        })
    },
    store: function (e) {
        e.preventDefault();
        $(".error-message").text('')
        let dataInput = CategoryClass.getFormData();
        let callApiToStore = callApi(urlStoreCategory, 'post', dataInput);
        callApiToStore.done(function(response){
            if (response.error) {
                return swalError(response.error)
            }
            return swalSuccess(response.success).then(() => {
                $tableCategories.html(response.view)
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
        let dataInput = CategoryClass.getFormData();
        let callApiToStore = callApi(urlUpdateCategory, 'patch', dataInput);
        callApiToStore.done(function(response){
            if (response.error)
            {
                return swalError(response.error)
            }
            if (response.success) {
                return swalSuccess(response.success).then(() => {
                    $tableCategories.html(response.view)
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

    fillFormData: function (category = {}) {
        $(".error-message").text('');
        $categoryName.val(category['category_name'] || '');
        $categoryLevel.val(category['level' || levelChild]);
        $categoryId.val(category['id'] || '');
        $categoryFather.val(category['category_id'] || '');
        if (category['id']) {
            $modalForm.find('.modal-title').text(lblEdit);
            $modalForm.find('.btn-action').text(lblUpdate).addClass('btn-update').removeClass('btn-save');
        } else {
            $modalForm.find('.modal-title').text(lblCreate);
            $modalForm.find('.btn-action').text(lblSave).addClass('btn-save').removeClass('btn-update');
        }
    },
    getFormData: function () {
        console.log($categoryLevel.val(), $categoryFather.val())
        return {
            id: $categoryId.val(),
            _token: _token,
            category_name: $categoryName.val(),
            level: $categoryLevel.val(),
            category_id: $categoryFather.val(),
        }
    },
    getPage: function (page) {
        $.ajax({
            type: "GET",
            url: '?page='+ page
        }).done(function (response) {
            history.pushState(null, null, '?page=' + page);
            $tableCategories.html(response.view)
        })
    },
    getCategoryById: function (url, id) {
        return  $.ajax({
            type: "GET",
            url: url,
        })
    },

    showCategoryFatherOptions: function () {
        if ($categoryLevel.val() !== levelChild)
        {
            $categoryFatherWrap.hide();
        } else {
            $categoryFatherWrap.show();
        }
    }
}


