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
        <input type="text" name="username" class="form-control" placeholder="Enter username" value="{!! old('username') !!}">
        <input type="password" name="password" class="form-control" placeholder="Password" >
        <div class="btn-box">
            <button type="submit" id="submitBtn">Submit</button>
        </div>
        <div style="display: flex; justify-content: space-between">
            <a id="linkRegister" href="{{route('warehouse.create')}}">Register</a>
            <a id="linkForgot" href="{{route('forget.password.get')}}">Forgot password</a>
        </div>

    </form>
</div>
<script src="{!! asset('libs/jquery/jquery-3.6.0.js') !!}"></script>
</body>
</html>

