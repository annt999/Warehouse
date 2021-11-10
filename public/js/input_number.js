$(document).ready(function () {
    $(document).on('click', '.btn-number', function(e){
        e.preventDefault();
        type      = $(this).attr('data-type');
        var input = $(this).parent().find('.quantity-input');
        var currentVal = parseInt(input.val());
        var maxVal = input.attr('max');
        if (!isNaN(currentVal)) {
            if(type == 'minus') {
                if (!(currentVal - 1 <= 0)) {
                    input.val(currentVal - 1).change();
                }
            } else if(type == 'plus') {
                if (currentVal < maxVal) {
                    input.val(currentVal + 1).change();
                }
            }
        } else {
            input.val(1);
        }
    });
    $('.input-number').focusin(function(){
        $(this).data('oldValue', $(this).val());
    });
    $(".input-number").keydown(function (e) {
        // Allow: home, end, left, right
        if ((e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
})
