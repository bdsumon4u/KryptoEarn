<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <meta name=description
          content="Join us today and earn from the comfort of your home. We have easy and plenty tasks including solving captcha, carrying out surveys, proofreading articles, data entry, watching video adverts, and many more. Minimal skills required.">
    <meta name=keywords content="Earn, Cryptocurrency">
    <meta name=author content=Hotash>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha512-J6lfzvaWkmuRpFY1mCzmz8lAm3dHKdmtlHF4pkiwGIceWUTDBHc4pDjxAgEfk+VMRTqNQx2lF20qo4+0SJSUKQ=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
          integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
          crossorigin="anonymous"/>
    <link rel=stylesheet href="{{ asset('cryptoico/theme-assets/css/template-counter.min.css') }}">

    <link rel=stylesheet type="text/css"
          href="{{ asset('cryptoico/theme-assets/vendors/animate/animate.min.css') }}">

    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="{{ config('services.crisp.website_id') }}";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
</head>
<body class="1-column page-animated template-intro-video-default template-intro-video" data-menu-open=hover
      data-menu="">
<!-- Preloader | Comment below code if you don't want preloader-->
<div id=loader-wrapper>
    <svg viewbox=" 0 0 512 512" id=loader>
        <linearGradient id=loaderLinearColors x1=0 y1=0 x2=1 y2=1>
            <stop offset="5%" stop-color="#007bff"></stop>
            <stop offset="100%" stop-color="#fd7e14"></stop>
        </linearGradient>
        <g>
            <circle cx=256 cy=256 r=100 fill=none stroke="url(#loaderLinearColors)"/>
        </g>
        <g>
            <circle cx=256 cy=256 r=75 fill=none stroke="url(#loaderLinearColors)"/>
        </g>
        <circle cx=256 cy=256 r=60 fill="url(#loaderImage)" stroke=none stroke-width=0 />
        <!-- Change the preloader logo here -->
        <defs>
            <pattern id=loaderImage height="100%" width="100%" patternContentUnits=objectBoundingBox>
                <image href="{{ asset('logo-circle.svg') }}" preserveAspectRatio=none width=1 height=1></image>
            </pattern>
        </defs>
    </svg>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!--/ Preloader -->
<!-- /////////////////////////////////// HEADER /////////////////////////////////////-->
<!-- Header Start-->
<header class=page-header>
    <!-- Horizontal Menu Start-->
    <nav class="main-menu static-top navbar-dark navbar navbar-expand-lg fixed-top mb-1"
         style="background-color: #A34FFE;">
        <div class=container>
            <a class="navbar-brand animated fadeInDown" data-animation="fadeInDown" data-animation-delay="1s" href="/"
               style="animation-delay: 1s; opacity: 1;">
                <img src="{{ asset('logo-circle.svg') }}" class="navbar-brand-logo" alt="Logo/">
                <img src="{{ asset('logo-circle.svg') }}" class="navbar-brand-logo-dark d-none" alt="Logo/">
                <span class="brand-text font-weight-bold">{{ config('app.name') }}</span>
            </a>
            <button class=navbar-toggler type=button data-toggle=collapse data-target="#navbarCollapse"
                    aria-controls=navbarCollapse aria-expanded=false aria-label="Toggle navigation">
                <span class=navbar-toggler-icon></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div id="navigation" class="navbar-nav ml-auto">
                    <ul class="navbar-nav mt-1">
                        <li class="nav-item animated" data-animation=fadeInDown data-animation-delay="1.2s">
                            <a class=nav-link href="{{ url('/#about') }}">About</a>
                        </li>
                        <li class="nav-item animated" data-animation=fadeInDown data-animation-delay="1.3s">
                            <a class=nav-link href="{{ url('/#pricing') }}">Pricing</a>
                        </li>
                        <li class="nav-item animated" data-animation=fadeInDown data-animation-delay="1.4s">
                            <a class=nav-link href="{{ url('/#faq') }}">FAQS</a>
                        </li>
                        <li class="nav-item animated" data-animation=fadeInDown data-animation-delay="1.5s">
                            <a class=nav-link href="{{ url('/#contact') }}">Contact us</a>
                        </li>
                        <li class="nav-item animated" data-animation=fadeInDown data-animation-delay="1.6s">
                            <a class=nav-link href="/proofs">Proofs</a>
                        </li>
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item animated" data-animation=fadeInDown data-animation-delay="1.7s">
                                    <a href="{{ route('dashboard') }}" class="nav-link">{{ __('Dashboard') }}</a>
                                </li>
                            @else
                                <li class="nav-item animated" data-animation=fadeInDown data-animation-delay="1.7s">
                                    <a class=nav-link href="{{ route('login') }}">{{ __('Log in') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item animated" data-animation=fadeInDown data-animation-delay="1.8s">
                                        <a class=nav-link href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                    <span id=slide-line></span>
                </div>
            </div>
        </div>
    </nav>
    <!-- /Horizontal Menu End-->
</header>
<!-- /Header End-->
<div class=content-wrapper>
    <div class=content-body>
        <main>
            <section id="testimonial" class="section-padding">
                <div class="container-fluid">
                    <div class="container">
                        <div class="heading text-center">
                            <h6 class="sub-title animated fadeInUpShorter"
                                data-animation="fadeInUpShorter"
                                data-animation-delay="0.2s"
                                style="animation-delay: 0.2s; opacity: 1;">Payment</h6>
                            <h2 class="title animated fadeInUpShorter" data-animation="fadeInUpShorter"
                                data-animation-delay="0.3s" style="animation-delay: 0.3s; opacity: 1;">Proofs</h2>
                        </div>
                        <div class="container">
                            <div class="shortcode-html">
                                <!-- Basic Table -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Country</th>
                                            <th>Phone</th>
                                            <th>Amount</th>
                                            <th>Gateway</th>
                                            <th>Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($withdraws as $withdraw)
                                            <tr>
                                                <td>{{ $withdraw->user->username }}</td>
                                                <td>{{ $withdraw->user->country }}</td>
                                                <td>{{ $withdraw->user->phone }}</td>
                                                <td>${{ $withdraw->amount }}</td>
                                                <td>{{ $withdraw->gatewayName }}</td>
                                                <td>{!! $withdraw->updated_at->diffForHumans() !!}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No Records Found</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div><!-- End Basic Table -->
                                {!! $withdraws->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
<!-- //////////////////////////////////// FOOTER ////////////////////////////////////-->
<footer class="footer static-bottom footer-dark footer-custom-class" data-midnight=default>
    <div class=container>
        <div class="footer-wrapper mx-auto text-center">
            <div class="footer-title mb-5 animated" data-animation=fadeInUpShorter data-animation-delay="0.2s">Stay
                updated with us
            </div>
            <p class="subscribe-desc mb-4 animated" data-animation=fadeInUpShorter data-animation-delay="0.4s">Follow us
                on the social links below and be the first to find about our latest products!</p>
            <ul class="social-buttons list-unstyled mb-5">
                <li class=animated data-animation=fadeInUpShorter data-animation-delay="0.5s">
                    <a href="#" title=Facebook class="btn btn-outline-facebook rounded-circle">
                        <i class="fa fa-facebook-f" aria-hidden="true"></i>
                    </a>
                </li>
                <li class=animated data-animation=fadeInUpShorter data-animation-delay="0.6s">
                    <a href="#" title=Twitter class="btn btn-outline-twitter rounded-circle">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                </li>
                <li class=animated data-animation=fadeInUpShorter data-animation-delay="0.8s">
                    <a href="#" title=Instagram class="btn btn-outline-instagram rounded-circle">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                </li>
                <li class=animated data-animation=fadeInUpShorter data-animation-delay="0.9s">
                    <a href="#" title=YouTube class="btn btn-outline-youtube rounded-circle">
                        <i class="fa fa-youtube" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                You must agree with our <a href="{{ route('policy.show') }}">{{ __('Privacy Policy') }}</a> and <a
                    href="{{ route('terms.show') }}">{{ __('Terms of Service') }}</a>.
            @endif
            <div>
                <span class="copyright animated" data-animation=fadeInUpShorter data-animation-delay="1.0s">Copyright &copy; 2021, {{ config('app.name') }}.</span>
            </div>
        </div>
    </div>
</footer>
<!-- BEGIN VENDOR JS-->
<script src="{{ asset('cryptoico/theme-assets/vendors/vendors.min.js') }}"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"
        integrity="sha512-CEiA+78TpP9KAIPzqBvxUv8hy41jyI3f2uHi7DGp/Y/Ka973qgSdybNegWFciqh6GrN2UePx2KkflnQUbUhNIA=="
        crossorigin="anonymous"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME JS-->
<script src="{{ asset('cryptoico/theme-assets/js/theme.js') }}"></script>
<!-- END CRYPTO JS-->
<!-- BEGIN PAGE LEVEL JS-->
<!-- END PAGE LEVEL JS-->
</body>
</html>
