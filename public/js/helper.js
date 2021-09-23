window.callApi = function (url, method, data) {
    return $.ajax({
        url: url,
        method: method,
        dataType: 'json',
        data: data,
    });
}

window.callApiWithFile = function (url, method, data) {
    let formData = new FormData();
    Object.keys(data).map((key) => {
        if (typeof data[key] === 'object') {
            data[key].forEach((item) => {
                formData.append(`${key}[]`, item);
            });
        } else {
            formData.append(key, data[key]);
        }
    });
    console.log(data['image'])

    return $.ajax({
        url: url,
        type: method,
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        dataType: 'json'
    });
}

window.getCurrentPage = function () {
    const params = new URLSearchParams(window.location.search);
    if (params.has("page")) {
        return params.get('page');
    }
    return 1;
}
/**
 * Sweet alert success
 */
window.swalSuccess = function (message) {
    return Swal.fire({
        icon: "success",
        text: message,
        confirmButtonText: lang.lblOk,
    });
}

/**
 * Sweet alert error
 */
window.swalError = function (message) {
    return Swal.fire({
        icon: "error",
        text: message,
        confirmButtonText: lang.lblOk,
    });
}


