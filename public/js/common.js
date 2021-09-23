window.ImageHelper = {
    showImage: function ($imageInput, $imageContainer) {
        $imageContainer.html('');
        let files = $imageInput.get('0').files;
        if (files.length) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $imageContainer.html(`<img src="${e.target.result}" alt="">`);
            };
            reader.readAsDataURL(files[0]);
        }
    },
};
