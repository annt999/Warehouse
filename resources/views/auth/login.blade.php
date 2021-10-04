{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>{!! __('view.login.login') !!}</title>--}}
{{--    <link rel="stylesheet" href="{{ asset('libs/font-awesome/css/all.css')}} ">--}}
{{--    <link rel="stylesheet" href="{{ asset('libs/font-awesome/js/all.js')}} ">--}}
{{--    <link rel="stylesheet" href="{{ asset('libs/bootstrap/css/bootstrap.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/login.css')}}">--}}
{{--</head>--}}
{{--<body class="login-page">--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-12 col-sm-6 col-md-3">--}}
{{--                <form class="form-login" action="{!! route('auth.login.post') !!}" method="post">--}}
{{--                    @csrf--}}
{{--                    <div class="form-group">--}}
{{--                        <h3>--}}
{{--                            {{__('view.login.login')}}--}}
{{--                        </h3>--}}
{{--                    </div>--}}
{{--                    @error('message')--}}
{{--                    <span class="text-danger">{!! $message !!}</span>--}}
{{--                    @enderror--}}
{{--                    <div class="form-group">--}}
{{--                        <label>User name</label>--}}
{{--                        <input type="text" name="user_name" class="form-control" placeholder="Enter email" value="{!! old('user_name') !!}">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Password</label>--}}
{{--                        <input type="password" name="password" class="form-control" placeholder="Password" >--}}
{{--                    </div>--}}
{{--                    <button type="submit" class="btn btn-primary btn-block">Submit</button>--}}
{{--                    <p></p>--}}
{{--                    <a href="{{route('forget.password.get')}}">Forgot password</a>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</body>--}}
{{--</html>--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="top-row"></div>
    <form class="form-login" action="{!! route('auth.login.post') !!}" method="post">
        @csrf
        <div class="form-group">
            <h3>
                {{__('view.login.login')}}
            </h3>
        </div>
        @error('message')
        <span class="text-danger">{!! $message !!}</span>
        @enderror
        <input type="text" name="user_name" class="form-control" placeholder="Enter email" value="{!! old('user_name') !!}">
        <input type="password" name="password" class="form-control" placeholder="Password" >
        <div class="btn-box">
            <button type="button" id="backBtn">Back</button>
            <button type="submit" id="submitBtn">Submit</button>
        </div>
        <a id="linkForgot" href="{{route('forget.password.get')}}">Forgot password</a>
    </form>
</div>
<script src="{!! asset('libs/jquery/jquery-3.6.0.js') !!}"></script>
</body>
</html>

