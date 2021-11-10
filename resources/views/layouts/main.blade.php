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
            <h1>Warehouse</h1>
        </div>
        <ul class="list-unstyled components">
            @if(auth()->check())
                @if(auth()->user()->isAdmin())
                    <li>
                        <a href="{{route('warehouse.index')}}">Warehouses management</a>
                    </li>
                @else
                    <li class="{{ Route::is('home') ? 'route-active' : '' }}">
                        <a href="{{route('home')}}">Home</a>
                    </li>
                    @if(auth()->user()->isStorekeeper())
                        <li class="{{ Route::is('user.*') ? 'route-active' : '' }}">
                            <a href="{{route('user.index')}}">
                                Employees
                            </a>
                        </li>
                    @endif
                    <li class="{{ Route::is('product.*') ? 'route-active' : '' }}">
                        <a href="{{route('product.index')}}">Products</a>
                    </li>
                    <li class="dropdown-nav">
                        <a href="#" class="">
                            Orders
                            <i style="color: white; padding-left: 20px" class="fas fa-caret-down"></i>
                        </a>
                        <ul class="sub-dropdown-nav {{ Route::is('order.*') ? 'dropdown-nav-active' : '' }}">
                            <li class="{{ Route::is('order.sale.history') ? 'route-active' : '' }}">
                                <a href="{{route('order.sale.history')}}">
                                    Sale
                                </a>
                            </li>
                            <li class="{{ Route::is('order.import.history') ? 'route-active' : '' }}">
                                <a href="{{route('order.import.history')}}">
                                    Import
                                </a>
                            </li>
                        </ul>
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
{{--                    <li class="{{ Route::is('customer.*') ? 'route-active' : '' }}">--}}
{{--                        <a href="{{route('customer.index')}}">Customers</a>--}}
{{--                    </li>--}}
                    <li class="dropdown-nav">
                        <a href="#" class="">
                            Customers
                            <i style="color: white; padding-left: 20px" class="fas fa-caret-down"></i>
                        </a>
                        <ul class="sub-dropdown-nav {{ Route::is('customer.*') ? 'dropdown-nav-active' : '' }}">
                            <li class="{{ Route::is('customer.index') ? 'route-active' : '' }}">
                                <a href="{{route('customer.index')}}">
                                    List
                                </a>
                            </li>
                            <li class="{{ Route::is('customer.transaction') ? 'route-active' : '' }}">
                                <a href="{{route('customer.transaction')}}">
                                    Transactions
                                </a>
                            </li>
                        </ul>
                    </li>
                        <li class="dropdown-nav">
                            <a href="#" class="">
                                Report
                                <i style="color: white; padding-left: 20px" class="fas fa-caret-down"></i>
                            </a>
                            <ul class="sub-dropdown-nav {{ Route::is('report.*') ? 'dropdown-nav-active' : '' }}">
                                <li class="{{ Route::is('report.product') ? 'route-active' : '' }}">
                                    <a href="{{route('report.product')}}">
                                        Report by product
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <li class="{{ Route::is('supplier.*') ? 'route-active' : '' }}">
                        <a href="{{route('supplier.index')}}">Suppliers</a>
                    </li>
                @endif
            @else
                <li class="{{ Route::is('home.guest') ? 'route-active' : '' }}">
                    <a href="{{route('home.guest')}}">Home</a>
                </li>
                <li class="{{ Route::is('warehouse.*') ? 'route-active' : '' }}">
                    <a href="{{route('warehouse.create')}}">Create warehouse</a>
                </li>
                <li>
                    <a href="{{route('auth.login')}}">Login</a>
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
