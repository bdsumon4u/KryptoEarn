<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" >
    <meta name=description content="Join us today and earn from the comfort of your home. We have easy and plenty tasks including solving captcha, carrying out surveys, proofreading articles, data entry, watching video adverts, and many more. Minimal skills required.">
    <meta name=keywords content="Earn, Cryptocurrency">
    <meta name=author content=Hotash>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel=stylesheet>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel=stylesheet>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha512-rO2SXEKBSICa/AfyhEK5ZqWFCOok1rcgPYfGOqtX35OyiraBg6Xa4NnBJwXgpIRoXeWjcAmcQniMhp22htDc6g==" crossorigin="anonymous" />
    <link rel=stylesheet type="text/css" href="{{ asset('cuba/user1/assets/css/style.css') }}">
    <link rel=stylesheet type="text/css" href="{{ asset('cuba/user1/assets/css/responsive.css') }}">
<body>
<!-- login page start-->
<div class=container-fluid>
    <div class=row>
        <div class="col-xl-7 order-1">
            <img class="bg-img-cover bg-center" src="{{ asset('cuba/user1/assets/images/login/1.jpg') }}" alt="Login Page">
        </div>
        <div class="col-xl-5 p-0">
            <div class=login-card>
                <div>
                    <div class=login-main>
                        <div style="width: 4rem; height: 4rem; margin-bottom: 1rem;">
                            <x-jet-authentication-card-logo />
                        </div>
                        <form method=POST action="{{ route('login') }}" accept-charset=UTF-8 id="login" class="theme-form needs-validation" novalidate>
                            <h4>{{ __('Log in to your account') }}</h4>
                            @csrf

                            <div class="form-group">
                                <x-jet-label for="identity" class="col-form-label" value="{{ __('Identity') }}" />
                                <x-jet-input id="identity" class="form-control" type="text" name="identity" placeholder="Email/Username" :value="old('identity')" required />
                                <x-jet-input-error for="identity" class="text-danger my-1" />
                            </div>

                            <div class="form-group">
                                <x-jet-label for="password" class="col-form-label" value="{{ __('Password') }}" />
                                <x-jet-input id="password" class="form-control" type="password" name="password" placeholder="********" required autocomplete="new-password" />
                                <x-jet-input-error for="password" class="text-danger my-1" />
                                <div class="show-hide"><span class=show></span></div>
                            </div>

                            <div class="form-group">
                                <label for="remember_me" class="block">
                                    <x-jet-checkbox id="remember_me" name="remember" />
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div class="d-flex align-items-center justify-content-end mb-2">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">{{ __('Log in') }}</button>
                            <p class="mt-4 mb-0">{{ __('Don\'t have an account?') }}<a class="ml-2" href="{{ route('register') }}">{{ __('Create an Account') }}</a></p>

                            <script>
                                (function () {
                                    'use strict';
                                    window.addEventListener('load', function () {
                                        var forms = document.getElementsByClassName('needs-validation');
                                        var validation = Array.prototype.filter.call(forms, function (form) {
                                            form.addEventListener('submit', function (event) {
                                                if (form.checkValidity() === false) {
                                                    event.preventDefault();
                                                    event.stopPropagation();
                                                }
                                                form.classList.add('was-validated');
                                            }, false);
                                        });
                                    }, false);
                                })();
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script><script src="{{ asset('cuba/user1/assets/js/script.js') }}"></script>
</body>
</html>
