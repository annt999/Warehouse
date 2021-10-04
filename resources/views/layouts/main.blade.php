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
            @if(auth()->check())
                @if(auth()->user()->isAdmin())
                    <li>
                        <a href="#">Warehouses management</a>
                    </li>
                @else
                    <li class="{{ Route::is('user.*') ? 'route-active' : '' }}">
                        <a href="{{route('user.index')}}">
                            Employees
                        </a>
                    </li>
                    <li class="{{ Route::is('product.*') ? 'route-active' : '' }}">
                        <a href="{{route('product.index')}}">Products</a>
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
                @endif
            @else
                <li class="{{ Route::is('warehouse.*') ? 'route-active' : '' }}">
                    <a href="{{route('warehouse.create')}}">Create warehouse</a>
                </li>
                <li>
                    <a href="#">Login</a>
                </li>
            @endif
        </ul>
    </nav>
    <div id="content-wrapper">
        <ul id="nav-content-header" class="nav">
            <li class="nav-item mr-auto">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                </button>
                <span style="color: #247a8b; font-weight: 900">{{ $warehouse_name }}</span>
            </li>
            @if(auth()->check())
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
            @endif
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
