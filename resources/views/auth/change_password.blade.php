<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('view.change_password.change_password')}}</title>
    <link rel="stylesheet" href="{{ asset('libs/font-awesome/css/all.css')}} ">
    <link rel="stylesheet" href="{{ asset('libs/font-awesome/js/all.js')}} ">
    <link rel="stylesheet" href="{{ asset('libs/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('libs/sweet-alert/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body class="login-page">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-md-3" style="margin-top: 50px">
            <form class="form-login change-password-form" action="{!! route('password.change.post') !!}" method="post" style="background-color: white; padding: 15px;">
                @csrf
                <div class="form-group">
                    <h3>
                        {{__('view.change_password.change_password')}}
                    </h3>
                </div>
                <div class="form-group">
                    <label>{{__('view.change_password.current_password')}}</label>
                    <input type="password" name="current_password" class="form-control" placeholder="{{__('view.change_password.current_password')}}" >
                    <div class="text-danger d-none error-message" id="current_password_error"></div>
                </div>
                <div class="form-group">
                    <label>{{__('view.change_password.new_password')}}</label>
                    <input type="password" name="new_password" class="form-control" placeholder="{{__('view.change_password.new_password')}}">
                    <div class="text-danger d-none error-message" id="new_password_error"></div>
                </div>
                <div class="form-group">
                    <label>{{__('view.change_password.password_confirmation')}}</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{__('view.change_password.password_confirmation')}}">
                    <div class="text-danger d-none error-message" id="password_confirmation_error"></div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-change-password">Submit</button>
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
