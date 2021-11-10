<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
    <link rel="stylesheet" href="{{ asset('libs/sweet-alert/sweetalert2.min.css')}}">
    <title>Register</title>
</head>
<body>
<div class="container">
    <form id="createWareHouseForm">
        <h3>CREATE WAREHOUSE</h3>
        <input type="text" placeholder="Name" name="warehouse_name" id="warehouse_name">
        <div class="text-danger d-none error-message" id="warehouse_name_error"></div>
        <div class="btn-box">
            <button type="button" onclick="history.back()">Back</button>
            <button type="button" id="nextBtn">Next</button>
        </div>
    </form>
    <form id="createAccountForm">
        <h3>CREATE ACCOUNT</h3>
        <input type="text" placeholder="User name" name="username" id="username">
        <div class="text-danger d-none error-message" id="username_error"></div>
        <input type="text" placeholder="Full name" name="name" id="name">
        <div class="text-danger d-none error-message" id="name_error"></div>
        <input type="text" placeholder="Email" name="email" id="email">
        <div class="text-danger d-none error-message" id="email_error"></div>
        <input type="text" placeholder="Phone number" name="phone_number" id="phone_number">
        <div class="text-danger d-none error-message" id="phone_number_error"></div>
        <input type="password" placeholder="Password" name="password" id="password">
        <div class="text-danger d-none error-message" id="password_error"></div>
        <input type="password" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation">
        <div class="text-danger d-none error-message" id="password_confirmation_error"></div>

        <div class="btn-box">
            <button type="button" id="backBtn">Back</button>
            <button type="button" id="submitBtn">Submit</button>
        </div>
    </form>
    <div class="step-row">
        <div id="progress"></div>
        <div class="step-col"><small>Create warehouse</small></div>
        <div class="step-col"><small>Create account</small></div>
    </div>
</div>
<script>
    var _token = '{!! csrf_token() !!}';
    var urlLogin = '{!! route('auth.login') !!}';
    var urlStoreWarehouse = '{!! route('warehouse.store') !!}';
</script>
<script src="{!! asset('libs/sweet-alert/sweetalert2.min.js') !!}"></script>
<script src="{!! asset('libs/jquery/jquery-3.6.0.js') !!}"></script>
<script src="{!! asset('js/helper.js') !!}"></script>
<script src="{{ asset('js/register.js') }}"></script>

</body>
</html>
