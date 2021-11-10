$(document).ready(function () {
    $(document).on('click', '.dropdown-nav a', function () {
        $(this).parent().find('.sub-dropdown-nav').toggleClass('dropdown-nav-active');
    })
})
