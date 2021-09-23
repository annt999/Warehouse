<!DOCTYPE html>
<html lang="ja">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.css')
    @yield('style')
</head>

<body>
<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h1>Ware house</h1>
        </div>
        <ul class="list-unstyled components">
            <li>
                <a href="#">Home</a>
            </li>
            <li class="{{ Route::is('user.*') ? 'route-active' : '' }}">
                <a href="{{route('user.index')}}">
                        Users
                </a>
            </li>
            <li>
                <a href="#">Products</a>
            </li>
            <li>
                <a href="#">Orders</a>
            </li>
            <li class="{{ Route::is('location.*') ? 'route-active' : '' }}">
                <a href="{{route('location.index')}}">Locations</a>
            </li>
            <li class="{{ Route::is('brand.*') ? 'route-active' : '' }}">
                <a href="{{route('brand.index')}}">Brands</a>
            </li>
            <li class="{{ Route::is('category.*') ? 'route-active' : '' }}">
                <a href="{{route('category.index')}}">Categories</a>
            </li>
            <li>
                <a href="#">Customers</a>
            </li>
        </ul>
    </nav>
    <div id="content-wrapper">
        <ul id="nav-content-header" class="nav">
            <li class="nav-item mr-auto">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                </button>
            </li>
            <li class="nav-item">
                <div class="user-panel d-flex">
                    <div class="image">
                        <img src="{{ asset('file/background-login.jpg') }}" class="img-circle img-user">
                    </div>
                    <div class="info dropdown">
                        <a href="#" class="d-block dropdown-toggle" data-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                                <li><a href="{{route('password.change.get')}}">Change password</a></li>
                                <li><a href="{{ route('auth.logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
        <div class="content">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        @yield('header')
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <div class="main-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.script')
@yield('script')
</body>
</html>
