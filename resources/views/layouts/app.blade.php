<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/navbar.js') }}" defer></script>
</head>
<body >
    <div id="wrapper" >

        <div id="sidebar-wrapper">
            <ul class="sidebar-nav ">
                <li class="sidebar-brand mt-5">
                    <a href="{{ route('home') }}"> Start</a>
                </li>
                <li class="sidebar-brand">
                    <a href="{{ route('invoices') }}"> Faktury</a>
                </li>
                <li class="sidebar-brand">
                    <a href="{{ route('products') }}"> Magazyn</a>
                </li>
                <li class="sidebar-brand">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"> Wyloguj</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>

        <div id="page-content-wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">

{{--                        <a class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">--}}

                        <a href="#menu-toggle" class="btn btn-light" id="menu-toggle">
                            <img style="height: 30px" src="{{asset('images/menu_icon.png')}}" alt="menuIcon" class="image">
{{--                            <i class="fas fa-bars"></i>--}}
                        </a>

                        @yield('content')
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
</html>



