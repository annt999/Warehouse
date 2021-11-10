window.callApi = function (url, method, data) {
    return $.ajax({
        url: url,
        method: method,
        dataType: 'json',
        data: data,
    });
}

window.callApiWithFile = function (url, method, data) {
    console.log(data)
    let formData = new FormData();
    Object.keys(data).map((key) => {
        if (typeof data[key] === 'object') {
            console.log("vao 1")
            data[key].forEach((item) => {
                formData.append(`${key}[]`, item);
            });
        } else {
            formData.append(key, data[key]);
        }
    });
    console.log(formData)

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
        confirmButtonText: "Ok",
    });
}

/**
 * Sweet alert error
 */
window.swalError = function (message) {
    return Swal.fire({
        icon: "error",
        text: message,
        confirmButtonText: "Ok",
    });
}

window.isNumber = function (evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ( (charCode > 31 && charCode < 48) || charCode > 57) {
        return false;
    }
    return true;
}

window.GetURLParameter = function (sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++){
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return sParameterName[1];
        }
    }
}



