<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- title -->
    <title>Big Poppin</title>
    <!-- Scripts -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- stripe script --}}
    <script src="https://js.stripe.com/v3/"></script>




    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            text-align: center
        }
    </style>

    @yield('extra-css')
    
</head>

<body>
    <div id="app" class="mainPageOuterContainer">
        <div class="mainPageInnerContainer">

            


            <main class="py-0">
                {{-- @yield('navbar') --}}
                @yield('content')     
                <div id="mainViewWrapper">
                    <div id="vue-app">
                        <app></app>
                    </div>
                </div>
            </main>

        <div class="footerRow row pt-3 pb-3 pl-3 pr-3">
            <div class="col-12">
                <div class="links">
                    <a href="{{ url('/') }}">Music</a>
                    <a href="https://bigpoppin.bandcamp.com">Bandcamp</a>
                    <a href="https://twitter.com">Twitter</a>
                    <a href="https://blog.laravel.com">About</a>
                </div>
            </div>
        </div>
        </div>
    </div>

    {{-- VUE JS APP SCRIPT --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
    @yield('extra-js')
</html>
