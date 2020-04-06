<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Freelance Marketplace')</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    @yield('script')
    <script src="{{ asset('js/app.js') }}" defer></script>


    <script type="text/javascript"></script>

    <!-- Fonts and CSS -->

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">


</head>
<body>

<style type="text/css">

    nav
    {
        font-weight: 900;
    }

    .login, .signup
    {
        font-size: 17px;
        color: #626569;
    }

    .home, .logout
    {
        font-size: 17px;
        color: #626569;
    }

    .signup
    {
        margin-left: 30px;
        margin-right: 15px;
    }

</style>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <a class="navbar-brand" href="/"><strong>MarketPlace</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
        </ul>

    <!-- @if (Route::has('login'))
        @auth
            <a href="{{ url('/home') }}">Login</a>
                @else
            <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
                    @endif
        @endauth

    @endif
        -->
        @if (! auth()->user())
            <a class="login" href="{{ route('login') }}">Login</a>
            <a class="signup" href="{{ route('register') }}">Sign up</a>

            {{--  <a class="login" href="/login">Login</a>
             <a class="signup" href="/register">Sign up</a> --}}

        @elseif (auth()->user())

            <a class="home mr-3" href="/">Home</a>
            <!-- <a class="logout" href="/logout">Logout</a> -->
            <form method="post" action="/logout">
                @csrf
                <button type="submit">logout</button>
            </form>

        @elseif (auth()->user() == 'client')

            <a class="home mr-3" href="/">Home</a>
            <a class="logout" href="client/logout">Logout</a>

        @endif
    </div>
</nav>


<div class='mt-5 ml-2'>

    @yield('content')

</div>

</body>
</html>
