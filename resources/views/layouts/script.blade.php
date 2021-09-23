<script src="{!! asset('libs/popper/popper.min.js') !!}" ></script>
<script src="{!! asset('libs/jquery/jquery-3.6.0.js') !!}"></script>
<script src="{!! asset('libs/bootstrap/js/bootstrap.js') !!}"></script>
<script src="{!! asset('libs/sweet-alert/sweetalert2.min.js') !!}"></script>

<script src="{!! asset('js/helper.js') !!}"></script>
<script src="{!! asset('js/common.js') !!}"></script>



<script>
    var _token = '{!! csrf_token() !!}';
    {{--var baseUrl = '{!! rtrim(asset('/'), '/') !!}';--}}
    {{--var urlLogin = '{!! route('auth.login') !!}';--}}
    var lang = {
        lblOk: '{!! __('view.Ok') !!}',
        titleError: '{!! __('view.error') !!}',
        msgCommonError: '{!! __('message.common_error') !!}',
    }

    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });

</script>
