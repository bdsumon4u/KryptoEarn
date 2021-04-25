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
</head>
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
                        <form method="POST" action="{{ route('register') }}" accept-charset=UTF-8 class="theme-form needs-validation" novalidate>
                            <h4>{{ __('Create an account') }}</h4>
                            @csrf

                            <div>
                                <x-jet-label for="name" class="col-form-label" value="{{ __('Name') }}" />
                                <x-jet-input id="name" class="form-control" type="text" name="name" placeholder="Full Name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-jet-input-error for="name" class="text-danger my-1" />
                            </div>

                            <div class="form-group">
                                <x-jet-label for="email" class="col-form-label" value="{{ __('Email') }}" />
                                <x-jet-input id="email" class="form-control" type="email" name="email" placeholder="Email Address" :value="old('email')" required />
                                <x-jet-input-error for="email" class="text-danger my-1" />
                            </div>

                            <div class="form-group">
                                <x-jet-label for="username" class="col-form-label" value="{{ __('Username') }}" />
                                <x-jet-input id="username" class="form-control" type="text" name="username" :value="old('username')" required />
                                <x-jet-input-error for="username" class="text-danger my-1" />
                            </div>

                            <div class="form-group">
                                <x-jet-label for="referrer" class="col-form-label" value="{{ __('Referrer') }}" />
                                <x-jet-input id="referrer" class="form-control" type="text" name="referrer" :value="old('referrer', request('ref', 'No Referrer'))" required readonly />
                                <x-jet-input-error for="referrer" class="text-danger my-1" />
                            </div>

                            <div class="form-group">
                                <x-jet-label for="password" class="col-form-label" value="{{ __('Password') }}" />
                                <x-jet-input id="password" class="form-control" type="password" name="password" placeholder="********" required autocomplete="new-password" />
                                <x-jet-input-error for="password" class="text-danger my-1" />
                                <div class="show-hide"><span class=show></span></div>
                            </div>

                            <div class="form-group">
                                <x-jet-label for="password_confirmation" class="col-form-label" value="{{ __('Confirm Password') }}" />
                                <x-jet-input id="password_confirmation" class="form-control" type="password" placeholder="********" name="password_confirmation" required autocomplete="new-password" />
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="form-group">
                                    <x-jet-label for="terms">
                                        <div class="d-flex align-items-center">
                                            <x-jet-checkbox name="terms" id="terms"/>

                                            <div class="ml-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <x-jet-input-error for="terms" class="text-danger my-1" />
                                    </x-jet-label>
                                </div>
                            @endif

                            <button class="btn btn-primary btn-block" type=submit>{{ __('Register') }}</button>
                            <p class="mt-4 mb-0">{{ __('Already registered?') }}<a class="ml-2" href="{{ route('login') }}">{{ __('Log in') }}</a></p>

                            <script>
                                (function(){
                                    'use strict';
                                    window.addEventListener('load', function(){
                                        var forms = document.getElementsByClassName('needs-validation');
                                        var validation = Array.prototype.filter.call(forms, function(form){
                                            form.addEventListener('submit', function(event){
                                                if (form.checkValidity() === false){
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="{{ asset('cuba/user1/assets/js/script.js') }}"></script>
</div>
</body>
</html>
