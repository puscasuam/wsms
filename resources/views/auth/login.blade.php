<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
{{--        <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--            <div>Home</div>--}}
{{--        </a>--}}
{{--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"--}}
{{--                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
{{--            <!-- Left Side Of Navbar -->--}}
{{--            <ul class="navbar-nav mr-auto">--}}

{{--            </ul>--}}

{{--            <!-- Right Side Of Navbar -->--}}


            <ul class="navbar-nav ml-auto">
{{--                <a class="nav-item" href="{{ url('/') }}">--}}
{{--                    <div>Home</div>--}}
{{--                </a>--}}


                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">{{ __('Home') }}</a>
                    </li>

                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    {{--    <div class="row h-100 no-gutters">--}}
    {{--        <div class="col-lg-4">--}}
    {{--            <img src="/img/login2.jpg" alt="jewlry" style="width:100%">--}}
    {{--        </div>--}}
    {{--        <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">--}}
    {{--            <h4 class="mb-0"><div>Welcome back,</div><span>Please sign in to your account.</span></h4>--}}
    {{--            <div class="divider"></div>--}}
    {{--            <form>--}}
    {{--                <div class="row">--}}
    {{--                    <div class="col-md-6">--}}
    {{--                        <fieldset class="form-group">--}}
    {{--                            <div role="group" tabindex="-1">--}}
    {{--                                <label>Email</label>--}}
    {{--                                <input>--}}
    {{--                            </div>--}}
    {{--                        </fieldset>--}}
    {{--                    </div>--}}

    {{--                    <div class="col-md-6">--}}
    {{--                        <fieldset class="form-group">--}}
    {{--                            <div role="group" tabindex="-1">--}}
    {{--                                <label>Password</label>--}}
    {{--                                <input>--}}
    {{--                            </div>--}}
    {{--                        </fieldset>--}}
    {{--                    </div>--}}
    {{--                    <div class="custom-control custom-checkbox"><input autocomplete="off"--}}
    {{--                                                                       class="custom-control-input" id="exampleCheck"--}}
    {{--                                                                       name="check" type="checkbox" value="true">--}}
    {{--                        <label class="custom-control-label" for="exampleCheck"> Keep me logged in </label>--}}
    {{--                    </div>--}}

    {{--                    <div class="divider"></div>--}}

    {{--                    <div class="d-flex align-items-center"><div class="ml-auto">--}}
    {{--                            <a class="btn-lg btn btn-link" href="">Recover Password</a>--}}
    {{--                            <button class="btn btn-primary btn-lg" type="button">Login to Dashboard</button></div></div>--}}
    {{--                </div>--}}

    {{--            </form>--}}
    {{--        </div>--}}
    {{--    </div>--}}


    <div class="row justify-content-center ">
        <div class="col-lg-4">
            <img src="/img/login2.jpg" alt="jewlry" style="width:100%">
        </div>

        <div class="col-md-12 col-lg-8">

            <div class="card" Style="border: none">

                <div class="card-body">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <label class="form-check-label" for="remember">
                                    {{ __('Please sign in to your account.') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>

