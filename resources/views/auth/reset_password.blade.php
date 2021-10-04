<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{!! __('view.reset_password.reset_password') !!}</title>
    <link rel="stylesheet" href="{{ asset('libs/font-awesome/js/all.js')}} ">
    <link rel="stylesheet" href="{{ asset('libs/sweet-alert/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
<div class="container">
    <div class="top-row"></div>
    <form class="reset-password-form" action="{!! route('reset.password.post') !!}" method="post">
        @csrf
        <div>
            <h3>
                {{__('view.reset_password.reset_password')}}
            </h3>
        </div>
        <input type="hidden" name="token" value="{{$token}}">
        <input type="password" name="password" placeholder="{{__('view.reset_password.new_password')}}">
        <div class="text-danger d-none error-message" id="password_error"></div>
        <input type="password" name="password_confirmation" placeholder="{{__('view.reset_password.confirm_password')}}">
        <div class="text-danger d-none error-message" id="password_confirmation_error"></div>
        <div class="btn-box">
            <button type="submit" class="btn-reset-password">Submit</button>
        </div>
    </form>
</div>
<script>
    var urlLogin = '{!! route('auth.login') !!}'
</script>
@include('layouts.script')
<script src="{{asset('js/auth.js')}}"></script>
</body>
</html>



