<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{!! __('view.forgot_password.forgot_password') !!}</title>
    <link rel="stylesheet" href="{{ asset('libs/font-awesome/css/all.css')}} ">
    <link rel="stylesheet" href="{{ asset('libs/font-awesome/js/all.js')}} ">
    <link rel="stylesheet" href="{{ asset('libs/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('libs/sweet-alert/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body class="login-page">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3">
            <form class="form-login forget-password-form" action="{!! route('forget.password.post') !!}" method="post">
                @csrf
                <div class="form-group">
                    <h3>
                        {{__('view.forgot_password.forgot_password')}}
                    </h3>
                </div>
                <div class="form-group">
                    <label>{{__('view.forgot_password.email_address')}}</label>
                    <input type="text" name="email" class="form-control" placeholder="Email">
                    <div class="text-danger d-none error-message" id="email_error"></div>

                </div>
                <button type="submit" class="btn btn-primary btn-block btn-forget-password">Submit</button>
            </form>
        </div>
    </div>
</div>
<script>
    var urlLogin = '{!! route('auth.login') !!}'
</script>
@include('layouts.script')
<script src="{{asset('js/auth.js')}}"></script>
</body>
</html>

