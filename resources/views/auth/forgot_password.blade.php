<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{!! __('view.forgot_password.forgot_password') !!}</title>
    <link rel="stylesheet" href="{{ asset('libs/sweet-alert/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <title>Forgot password</title>
</head>
<body>
<div class="container">
    <div class="top-row"></div>
    <form class="forget-password-form" action="{!! route('forget.password.post') !!}" method="post">
        @csrf
        <div class="form-group">
            <h3>
                {{__('view.forgot_password.forgot_password')}}
            </h3>
        </div>
        <input type="text" name="email" class="form-control" placeholder="Email">
        <div class="text-danger d-none error-message" id="email_error"></div>
        <div class="btn-box">
            <button type="button" id="backBtn" onclick="history.back()">Back</button>
            <button type="submit" class="btn-forget-password">Submit</button>
        </div>
    </form>
</div>
<script src="{!! asset('libs/jquery/jquery-3.6.0.js') !!}"></script>
<script>
    var urlLogin = '{!! route('auth.login') !!}'
</script>
@include('layouts.script')
<script src="{{asset('js/auth.js')}}"></script>
</body>
</html>

