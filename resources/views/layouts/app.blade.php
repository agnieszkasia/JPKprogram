<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>eFIRMA</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
{{--    <link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">--}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/navbar.js') }}" defer></script>
</head>
<body class="bg2">
    <div id="wrapper" >

        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="text-center mt-5 " >
                    <div class="sidebar-brand">

                    <a class="sidebar-nav-link h5" href="{{ route('profile') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="white" class="bi bi-people" viewBox="0 2 18 14">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                        </svg>
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="white" class="bi bi-person-fill" viewBox="0 2 18 12">--}}
{{--                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>--}}
{{--                            </svg>--}}
                        <br>
{{--                        {{Auth::user()->first_name}} {{Auth::user()->family_name}}<br>--}}
                        {{ Auth::user()->company}}
                        <div class="h7">
                            NIP: {{Auth::user()->nip}}
                        </div>
                    </a>
                    </div>
                </li>
                <li>
                    <div class="mx-3 border-bottom"></div>
                </li>

                <li>
                    <div class="sidebar-brand">
                        <a href="{{ route('home') }}"  class="sidebar-nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" class="bi bi-house" viewBox="0 0 18 18">
                                <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                            </svg>
                            Start
                        </a>
                    </div>
                </li>
                <li>
                    <div class="sidebar-brand">
                        <a href="{{ route('invoices') }}" class="sidebar-nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" class="bi bi-card-text" viewBox="0 0 18 18">
                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                            Faktury
                        </a>
                    </div>
                </li>
                <li>
                    <div class="sidebar-brand">
                        <a href="{{ route('products') }}" class="sidebar-nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" class="bi bi-clipboard-minus" viewBox="0 0 18 18">
                                <path fill-rule="evenodd" d="M5.5 9.5A.5.5 0 0 1 6 9h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                            </svg>
                            Magazyn
                        </a>
                    </div>
                </li>
                <li>
                    <div class="sidebar-brand">
                        <a href="{{ route('logout') }}" class="sidebar-nav-link"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white" class="bi bi-arrow-right-circle" viewBox="0 0 18 18">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                            </svg>
                            Wyloguj
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>

        <div id="page-content-wrapper">
            <a href="#menu-toggle" class="btn btn-light" style="position: static" id="menu-toggle">
                <img style="height: 30px" src="{{asset('images/menu_icon.png')}}" alt="menuIcon" class="image">
            </a>
            <div class="container">

                <div class="row">
                    <div class="col-lg-12">

                        @yield('content')
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
</html>



