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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha512-J6lfzvaWkmuRpFY1mCzmz8lAm3dHKdmtlHF4pkiwGIceWUTDBHc4pDjxAgEfk+VMRTqNQx2lF20qo4+0SJSUKQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" />
    <link rel=stylesheet href="{{ asset('cryptoico/theme-assets/css/template-counter.min.css') }}">
    <link rel=stylesheet type="text/css" href="{{ asset('cryptoico/theme-assets/vendors/animate/animate.min.css') }}">
    <x-onesignal-scripts />
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="{{ config('services.crisp.website_id') }}";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
</head>
<body class="1-column page-animated template-intro-video-default template-intro-video" data-menu-open=hover data-menu="">
<!-- Preloader | Comment below code if you don't want preloader-->
<div id=loader-wrapper>
    <svg viewbox=" 0 0 512 512" id=loader>
        <linearGradient id=loaderLinearColors x1=0 y1=0 x2=1 y2=1>
            <stop offset="5%" stop-color="#007bff"></stop>
            <stop offset="100%" stop-color="#fd7e14"></stop>
        </linearGradient>
        <g>
            <circle cx=256 cy=256 r=100 fill=none stroke="url(#loaderLinearColors)" />
        </g>
        <g>
            <circle cx=256 cy=256 r=75 fill=none stroke="url(#loaderLinearColors)" />
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
    <nav class="main-menu static-top navbar-dark navbar navbar-expand-lg fixed-top mb-1">
        <div class=container>
            <a class="navbar-brand animated fadeInDown" data-animation="fadeInDown" data-animation-delay="1s" href="/" style="animation-delay: 1s; opacity: 1;">
                <img src="{{ asset('logo-circle.svg') }}" class="navbar-brand-logo" alt="Logo/">
                <img src="{{ asset('logo-circle.svg') }}" class="navbar-brand-logo-dark d-none" alt="Logo/">
                <span class="brand-text font-weight-bold">{{ config('app.name') }}</span>
            </a>
            <button class=navbar-toggler type=button data-toggle=collapse data-target="#navbarCollapse" aria-controls=navbarCollapse aria-expanded=false aria-label="Toggle navigation">
                <span class=navbar-toggler-icon></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div id="navigation" class="navbar-nav ml-auto">
                    <ul class="navbar-nav mt-1">
                        <li class="nav-item animated" data-animation=fadeInDown data-animation-delay="1.2s">
                            <a class=nav-link href="#about">About</a>
                        </li>
                        <li class="nav-item animated" data-animation=fadeInDown data-animation-delay="1.3s">
                            <a class=nav-link href="#pricing">Pricing</a>
                        </li>
                        <li class="nav-item animated" data-animation=fadeInDown data-animation-delay="1.4s">
                            <a class=nav-link href="#faq">FAQS</a>
                        </li>
                        <li class="nav-item animated" data-animation=fadeInDown data-animation-delay="1.5s">
                            <a class=nav-link href="#contact">Contact us</a>
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
            <section class="head-area content" id=home data-midnight=white>
                <div class=bg-banner></div>
                <div class="head-content container-fluid d-flex align-items-center">
                    <div class=container>
                        <div class=banner-wrapper>
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <div>
                                        <h1 class=animated data-animation=fadeInUpShorter data-animation-delay="1.5s">Welcome to {{ config('app.name') }}</h1>
                                        <hr class=animated data-animation=fadeInUpShorter data-animation-delay="1.5s">
                                        <div class=animated data-animation=fadeInUpShorter data-animation-delay="1.3s">
                                            <h6 class="font-italic text-warning"><strong>Total User: {{ $totalUsers }}</strong></h6>
                                            <h6 class="font-italic text-warning"><strong>Total Withdraw: ${{ round($totalWithdraws, 2) }}</strong></h6>
                                        </div>
                                        <h5 class=animated data-animation=fadeInUpShorter data-animation-delay="1.6s">Earn money online with your PC/Phone</h5>
                                        <div class="purchase-token-btn mt-3">
                                            <a
                                                href="{{ route('register') }}"
                                                class="btn btn-lg btn-gradient-orange btn-round btn-glow py-3 animated"
                                                data-animation=fadeInUpShorter data-animation-delay="1.8s"
                                            >{{ __('Register') }}</a>
                                            <a
                                                href="{{ route('login') }}"
                                                class="btn btn-lg btn-gradient-orange btn-round btn-glow py-3 animated"
                                                data-animation=fadeInUpShorter
                                                data-animation-delay="1.9s"
                                            >{{ __('Log in') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 d-none d-lg-flex">
                                    <img
                                        class="img-fluid animated"
                                        data-animation=fadeInLeftShorter
                                        data-animation-delay="0.6s"
                                        src="{{ asset('cryptoico/theme-assets/images/optimized/work.webp') }}"
                                        alt="Welcome" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-ripple-animation d-md-block">
                    <div class=left-bottom-ripples>
                        <div class=ripples></div>
                    </div>
                    <div class=top-right-ripples>
                        <div class=ripples></div>
                    </div>
                </div>
            </section>
            <!--/ Header: Counter -->
            <!-- About -->
            <section class="about section-padding bg-color" id=about>
                <div class=container-fluid>
                    <div class=container>
                        <div class="heading text-center">
                            <h6 class="sub-title animated" data-animation=fadeInUpShorter data-animation-delay="0.2s">About</h6>
                            <h2 class="title animated" data-animation=fadeInUpShorter data-animation-delay="0.3s">Who Are We?</h2>
                            <div class="separator animated" data-animation=fadeInUpShorter data-animation-delay="0.3s">
                                <span class=large></span>
                                <span class=medium></span>
                                <span class=small></span>
                            </div>
                            <p class="content-desc animated" data-animation=fadeInUpShorter data-animation-delay="0.4s">
                                {{ config('app.name') }} is a tier one security provider focusing mainly on automatic on-demand
                                institutional captcha resolves. From the institutions, we are able to provide zero
                                technical knowledge jobs for anyone at any time.
                            </p>
                        </div>
                        <div class=content-area>
                            <div class=row>
                                <div class="col-md-12 col-lg-6 animated" data-animation=fadeInLeftShorter data-animation-delay="0.5s">
                                    <h4 class=title>More!</h4>
                                    Think of it. How many people
                                    are stuck solving captchas right now? Hundreds? Thousands? Yes, probably millions!
                                    You have been there too at one time.<br> We at {{ config('app.name') }} recognized this
                                    opportunity.
                                    Recognizing and typing data is a simple and interesting way to make extra income
                                    online. Solving captchas in this case.<br> So for all the captchas/images that
                                    humans, i.e people can't recognize on the first glance, we pay our freelancers to
                                    solve them
                                    thus doing away with the hustle for the end user - The human.
                                    <h4>Why Us? </h4>
                                    <p class="content-desc animated" data-animation=flipInUp> &#9989; Guaranteed weekly
                                        income<br> &#9989; Timely Instant payments<br> &#9989; Flexible working
                                        hours<br> &#9989; Work from anywhere at anytime<br> &#9989; 24/7 support<br>
                                        &#9989; Start working in 2 minutes<br>
                                    <p>
                                </div>
                                <div class="col-md-12 col-lg-6 animated" data-animation=fadeInRightShorter data-animation-delay="0.5s">
                                    <div class="position-relative float-xl-right what-is-crypto-img">
                                        <img class=img-fluid src="{{ asset('cryptoico/theme-assets/images/optimized/how-it-works.webp') }}" alt="What is Crypto?">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Pricing -->
            <section id=pricing class="section-pro section-padding">
                <div class=container-fluid>
                    <div class=container>
                        <div class="heading text-center">
                            <h6 class="sub-title animated" data-animation=fadeInUpShorter data-animation-delay="0.2s">Prices</h6>
                            <h2 class="title animated" data-animation=fadeInUpShorter data-animation-delay="0.3s">
                                <strong>Pricing Table</strong>
                            </h2>
                            <p class="content-desc animated" data-animation=flipInUp data-animation-delay="0.4s">
                                {{ config('app.name') }} gives you the power to hit the ground running, no matter your experience.
                                <br/>Our pricing is friendly for everyone and ensures optimal returns for your investment.
                            </p>
                        </div>
                        <div class=pricing-wrapper>
                            <div class=row>
                                @foreach($plans as $plan)
                                <div class="col-md-12 col-lg-4 col-xl-4 mb-sm-5 mb-xs-5">
                                    <div class="pricing-table {{ $loop->last ? 'recommended' : '' }}">
                                        <h3 class=pricing-title>{{ $plan->name }}</h3>
                                        <div class=price>${{ $plan->price }}<sup>/{{ $plan->validity }} days</sup>
                                        </div>
                                        <!-- Lista de Caracteristicas / Propiedades -->
                                        <ul class=table-list>
                                            <li>Daily Limit:<span> {{ $plan->task_limit }} Tasks</span></li>
                                            <li>Validity: <span class=unlimited>{{ $plan->validity }} days</span></li>
                                            <li>Earning Per Task: <span class=unlimited>${{ $plan->earning_per_task / 100 }}</span></li>
                                            <li>Min. Daily Earning: <span class=unlimited>${{ $plan->task_limit * $plan->earning_per_task / 100 }}</span></li>
                                            <li>Min. Total Earning: <span class=unlimited>${{ $plan->validity * $plan->task_limit * $plan->earning_per_task / 100 }}</span></li>
                                            <li>Instant Payout: <span class=unlimited>{{ $plan->instant_payouts ? 'Enabled' : 'Disabled' }}</span></li>
                                            <li>Minimum Withdraw: <span class=unlimited>${{ $plan->minimum_withdraw }}</span></li>
                                            <li>Payout Days: <span class=unlimited>{{ $plan->payout_days }}</span></li>
                                        </ul>
                                        <!-- Contratar / Comprar -->
                                        <div class=table-buy>
                                            <a href="{{ route('register') }}" class=pricing-action>Get Started</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Pricing -->
            <!-- FAQ -->
            <section id=faq class="faq section-padding bg-color">
                <div class=container-fluid>
                    <div class=container>
                        <div class="heading text-center">
                            <h6 class="sub-title animated" data-animation=fadeInUpShorter data-animation-delay="0.2s">FAQ</h6>
                            <h2 class="title animated" data-animation=fadeInUpShorter data-animation-delay="0.3s">Frequently Asked <strong>Questions</strong></h2>
                            <div class="separator animated" data-animation=fadeInUpShorter data-animation-delay="0.3s">
                                <span class=large></span>
                                <span class=medium></span>
                                <span class=small></span>
                            </div>
                            <p class="content-desc animated" data-animation=jello data-animation-delay="0.4s">Review more about
                                {{ config('app.name') }}, account set up, and security features.</p>
                        </div>
                        <div class=row>
                            <div class=col>
                                <nav>
                                    <div class="nav nav-pills nav-underline mb-5 animated" data-animation=fadeInUpShorter data-animation-delay="0.5s" id=myTab role=tablist>
                                        <a href="#general" class="nav-item nav-link active" id=general-tab data-toggle=tab aria-controls=general aria-selected=true role=tab>General</a>
                                        <a href="#ico" class="nav-item nav-link" id=ico-tab data-toggle=tab aria-controls=ico aria-selected=false role=tab>Membership</a>
                                        <a href="#token" class="nav-item nav-link" id=token-tab data-toggle=tab aria-controls=token aria-selected=false role=tab>Deposit</a>
                                        <a href="#client" class="nav-item nav-link" id=client-tab data-toggle=tab aria-controls=client aria-selected=false role=tab>Withdrawals</a>
                                        <a href="#legal" class="nav-item nav-link" id=legal-tab data-toggle=tab aria-controls=legal aria-selected=false role=tab>Security</a>
                                    </div>
                                </nav>
                                <div class=tab-content id=myTabContent>
                                    <div class="tab-pane fade show active" id=general role=tabpanel aria-labelledby=general-tab>
                                        <div id=general-accordion class="collapse-icon accordion-icon-rotate">
                                            <div class="card animated" data-animation=fadeInUpShorter data-animation-delay="0.1s">
                                                <div class=card-header id=headingOne>
                                                    <h5 class=mb-0>
                                                        <a
                                                            class="btn btn-link" data-toggle=collapse
                                                            data-target="#collapseOne" aria-expanded=true
                                                            aria-controls=collapseOne
                                                        >
                                                            What do I need to register?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id=collapseOne class="collapse show" aria-labelledby=headingOne data-parent="#general-accordion">
                                                    <div class=card-body>
                                                        To register, you only an email address. To get
                                                        paid, you will need a payment address for any of the payment
                                                        method we support.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card animated" data-animation=fadeInUpShorter data-animation-delay="0.2s">
                                                <div class=card-header id=headingTwo>
                                                    <h5 class=mb-0>
                                                        <a
                                                            class="btn btn-link collapsed" data-toggle=collapse
                                                            data-target="#collapseTwo" aria-expanded=false
                                                            aria-controls=collapseTwo
                                                        >
                                                            How do I start working?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id=collapseTwo class=collapse aria-labelledby=headingTwo data-parent="#general-accordion">
                                                    <div class=card-body>
                                                        First, create and verify your account. After
                                                        that, log into you account and click on the Earn link on the
                                                        side menu. You will be presented with some captcha to solve. Solve captcha to get paid.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card animated" data-animation=fadeInUpShorter data-animation-delay="0.3s">
                                                <div class=card-header id=headingThree>
                                                    <h5 class=mb-0>
                                                        <a
                                                            class="btn btn-link collapsed" data-toggle=collapse
                                                            data-target="#collapseThree" aria-expanded=false
                                                            aria-controls=collapseThree
                                                        >
                                                            How can I get paid?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id=collapseThree class=collapse aria-labelledby=headingThree data-parent="#general-accordion">
                                                    <div class=card-body>
                                                        You can get paid via Perfect Money, Bitcoin & Payeer.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id=ico role=tabpanel aria-labelledby=ico-tab>
                                        <div id=ico-accordion class="collapse-icon accordion-icon-rotate">
                                            <div class=card>
                                                <div class=card-header id=icoHeadingOne>
                                                    <h5 class=mb-0>
                                                        <a
                                                            class="btn btn-link" data-toggle=collapse
                                                            data-target="#icoCollapseOne" aria-expanded=true
                                                            aria-controls=icoCollapseOne
                                                        >
                                                            Do I need to pay to register?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id=icoCollapseOne class="collapse show" aria-labelledby=icoHeadingOne data-parent="#ico-accordion">
                                                    <div class=card-body>
                                                        No, you don't need to. We have free and paid
                                                        membership types. The former last for two weeks while the paid
                                                        ones last for a year.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=card>
                                                <div class=card-header id=icoHeadingTwo>
                                                    <h5 class=mb-0>
                                                        <a
                                                            class="btn btn-link collapsed" data-toggle=collapse
                                                            data-target="#icoCollapseTwo" aria-expanded=false
                                                            aria-controls=icoCollapseTwo
                                                        >
                                                            Can I upgrade from one package to another before it has expired?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id=icoCollapseTwo class=collapse aria-labelledby=icoHeadingTwo data-parent="#ico-accordion">
                                                    <div class=card-body>
                                                        Yes you can. However, you do not need to pay
                                                        the full price for the package. You only pay the difference in
                                                        amount between the two packages.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=card>
                                                <div class=card-header id=icoHeadingThree>
                                                    <h5 class=mb-0>
                                                        <a
                                                            class="btn btn-link collapsed" data-toggle=collapse
                                                            data-target="#icoCollapseThree" aria-expanded=false
                                                            aria-controls=icoCollapseThree
                                                        >
                                                            What do I gain by using my referral link to invite other people to join the site?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id=icoCollapseThree class=collapse aria-labelledby=icoHeadingThree data-parent="#ico-accordion">
                                                    <div class=card-body>
                                                        Having referrals is one way of boosting your
                                                        income. You earn a 20% commission for every task your referral
                                                        completes.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id=token role=tabpanel aria-labelledby=token-tab>
                                        <div id=token-accordion class="collapse-icon accordion-icon-rotate">
                                            <div class=card>
                                                <div class=card-header id=tokenHeadingOne>
                                                    <h5 class=mb-0>
                                                        <a
                                                            class="btn btn-link" data-toggle=collapse
                                                            data-target="#tokenCollapseOne" aria-expanded=true
                                                            aria-controls=tokenCollapseOne
                                                        >
                                                            What deposit methods are available?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id=tokenCollapseOne class="collapse show" aria-labelledby=tokenHeadingOne data-parent="#token-accordion">
                                                    <div class=card-body>We support BTC wallets, Payeer and perfect money.</div>
                                                </div>
                                            </div>
                                            <div class=card>
                                                <div class=card-header id=tokenHeadingTwo>
                                                    <h5 class=mb-0>
                                                        <a
                                                            class="btn btn-link collapsed" data-toggle=collapse
                                                            data-target="#tokenCollapseTwo" aria-expanded=false
                                                            aria-controls=tokenCollapseTwo
                                                        >
                                                            How do I deposit money to my account?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id=tokenCollapseTwo class=collapse aria-labelledby=tokenHeadingTwo data-parent="#token-accordion">
                                                    <div class=card-body>Once logged in, click on Deposit from the side menu and follow the prompts.</div>
                                                </div>
                                            </div>
                                            <div class=card>
                                                <div class=card-header id=tokenHeadingThree>
                                                    <h5 class=mb-0>
                                                        <a class="btn btn-link collapsed" data-toggle=collapse
                                                           data-target="#tokenCollapseThree" aria-expanded=false
                                                           aria-controls=tokenCollapseThree
                                                        >
                                                            How long does it take for the money to reflect in my account?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id=tokenCollapseThree class=collapse aria-labelledby=tokenHeadingThree data-parent="#token-accordion">
                                                    <div class=card-body>From a few minutes to an 30 minutes. It all depends on your deposit method.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id=client role=tabpanel aria-labelledby=client-tab>
                                        <div id=client-accordion class="collapse-icon accordion-icon-rotate">
                                            <div class=card>
                                                <div class=card-header id=clientHeadingOne>
                                                    <h5 class=mb-0>
                                                        <a
                                                            class="btn btn-link" data-toggle=collapse
                                                            data-target="#clientCollapseOne" aria-expanded=true
                                                            aria-controls=clientCollapseOne
                                                        >
                                                            When can I withdraw?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id=clientCollapseOne class="collapse show" aria-labelledby=clientHeadingOne data-parent="#client-accordion">
                                                    <div class=card-body>Payout days are mentioned with your plan.</div>
                                                </div>
                                            </div>
                                            <div class=card>
                                                <div class=card-header id=clientHeadingTwo>
                                                    <h5 class=mb-0>
                                                        <a
                                                            class="btn btn-link collapsed" data-toggle=collapse
                                                            data-target="#clientCollapseTwo" aria-expanded=false
                                                            aria-controls=clientCollapseTwo
                                                        >
                                                            Is there a minimum withdrawal amount?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id=clientCollapseTwo class=collapse aria-labelledby=clientHeadingTwo data-parent="#client-accordion">
                                                    <div class=card-body>Yes. The minimum you can withdraw is 15 USD.</div>
                                                </div>
                                            </div>
                                            <div class=card>
                                                <div class=card-header id=clientHeadingThree>
                                                    <h5 class=mb-0>
                                                        <a
                                                            class="btn btn-link collapsed" data-toggle=collapse
                                                            data-target="#clientCollapseThree" aria-expanded=false
                                                            aria-controls=clientCollapseThree
                                                        >
                                                            Do I need referrals to withdraw funds?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id=clientCollapseThree class=collapse aria-labelledby=clientHeadingThree data-parent="#client-accordion">
                                                    <div class=card-body>
                                                        No, you do not need referrals to be able to
                                                        withdraw. You can withdraw your funds as long as you have 15 USD
                                                        and above.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id=legal role=tabpanel aria-labelledby=legal-tab>
                                        <div id=legal-accordion class="collapse-icon accordion-icon-rotate">
                                            <div class=card>
                                                <div class=card-header id=legalHeadingOne>
                                                    <h5 class=mb-0>
                                                        <a
                                                            class="btn btn-link" data-toggle=collapse
                                                            data-target="#legalCollapseOne" aria-expanded=true
                                                            aria-controls=legalCollapseOne
                                                        >

                                                            What is a Password?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id=legalCollapseOne class="collapse show" aria-labelledby=legalHeadingOne data-parent="#legal-accordion">
                                                    <div class=card-body>It is a word of minimum 8 character length that is used to safeguard your transactions.</div>
                                                </div>
                                            </div>
                                            <div class=card>
                                                <div class=card-header id=legalHeadingTwo>
                                                    <h5 class=mb-0>
                                                        <a
                                                            class="btn btn-link collapsed" data-toggle=collapse
                                                            data-target="#legalCollapseTwo" aria-expanded=false
                                                            aria-controls=legalCollapseTwo
                                                        >
                                                            I forgot my Password, what do I do?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id=legalCollapseTwo class=collapse aria-labelledby=legalHeadingTwo data-parent="#legal-accordion">
                                                    <div class=card-body>
                                                        Do not panic. Click on the Forgot Password
                                                        link in the login page. We will email you a link to reset the
                                                        Password.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=card>
                                                <div class=card-header id=legalHeadingThree>
                                                    <h5 class=mb-0>
                                                        <a class="btn btn-link collapsed" data-toggle=collapse data-target="#legalCollapseThree" aria-expanded=false aria-controls=legalCollapseThree>
                                                            Do I get logged out automatically once I stop using the site?
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id=legalCollapseThree class=collapse
                                                     aria-labelledby=legalHeadingThree data-parent="#legal-accordion">
                                                    <div class=card-body> No. Please make sure to log out of your
                                                        account if you are using a public computer.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ FAQ -->
            <!-- Testimonials -->
            <section id=testimonial class=section-padding>
                <div class=container-fluid>
                    <div class=container>
                        <div class="heading text-center">
                            <h6 class="sub-title animated" data-animation=fadeInUpShorter data-animation-delay="0.2s">TIO</h6>
                            <h2 class="title animated" data-animation=fadeInUpShorter data-animation-delay="0.3s">What Our Clients Say</h2>
                            <div class="separator animated" data-animation=fadeInUpShorter data-animation-delay="0.3s">
                                <span class=large></span>
                                <span class=medium></span>
                                <span class=small></span>
                            </div>
                            <p class="content-desc animated" data-animation=flipInUp data-animation-delay="0.4s">
                                Earning the trust and confidence of our clients has always been our highest priority.
                                Here is what some of our clients say of us.
                            </p>
                        </div>
                        <div class=row>
                            <div class="col-md-12 col-lg-4 mb-sm-5 mb-xs-5">
                                <div class=testimonial-card>
                                    <div class=test-text>Earning online has never been this easy! The company pays in time and the support is A+.</div>
                                    <div class=test-footer>
                                        <div class="test-image user-1"></div>
                                        <h4 class='test-person'>Eric Smith</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 mb-sm-5 mb-xs-5">
                                <div class=testimonial-card>
                                    <div class=test-text>One word: perfect! {{ config('app.name') }} has helped me actualize my financial freedom. It has been my most trusted stream of income.</div>
                                    <div class="test-footer f2">
                                        <div class="test-image user-2"></div>
                                        <h4 class='test-person'>Raphael Nick</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 mb-sm-5 mb-xs-5">
                                <div class=testimonial-card>
                                    <div class=test-text>I have been earning every day since I joined this platform. I highly recommend it.</div>
                                    <div class=test-footer>
                                        <div class="test-image user-3"></div>
                                        <h4 class='test-person'>Greg Jones</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Testimonials -->
            <!-- Contact -->
            <section id=contact class="contact section-padding bg-color">
                <div class=container-fluid>
                    <div class=container>
                        <div class="heading text-center">
                            <h6 class="sub-title animated" data-animation=fadeInUpShorter data-animation-delay="0.2s">TALK</h6>
                            <h2 class="title animated" data-animation=fadeInUpShorter data-animation-delay="0.3s">
                                <strong>Talk to US</strong>
                            </h2>
                            <p class="content-desc animated" data-animation=fadeInUpShorter data-animation-delay="0.4s">24/7 support</p>
                            <p class="content-desc animated" data-animation=fadeInUpShorter data-animation-delay="0.5s">
                                We pair our global 24/7/365 live chat with an extensive Support Center to help ensure
                                your questions are answered and your needs are met around the clock -- no matter who or
                                where you are.
                            </p>
                        </div>
                        <div class=row>
                            <div class="col-md-12 col-xl-8 mx-auto">
                                <x-validation-errors />
                                @if($message = session()->get('success'))
                                <div class="alert alert-success">{{ $message }}</div>
                                @endif
                                <form action="/contact-mail" method=post accept-charset=utf-8 class=text-center>
                                    @csrf
                                    <input type=text class="form-control animated" data-animation=fadeInUpShorter data-animation-delay="0.8s" name=name value="{{ old('name') }}" placeholder="Your Name" required />
                                    <input type=text class="form-control animated" data-animation=fadeInUpShorter data-animation-delay="0.9s" name=email value="{{ old('email') }}" placeholder="Your Mail" required />
                                    <textarea required rows=4 class="form-control animated" data-animation=fadeInUpShorter data-animation-delay="1.0s" name=message value="{{ old('message') }}" placeholder="Your Massage"></textarea>
                                    <button type=submit class="btn btn-lg btn-glow btn-gradient-orange btn-round animated" data-animation=fadeInUpShorter data-animation-delay="1.1s">Send Message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Contact -->
        </main>
    </div>
</div>
<!-- //////////////////////////////////// FOOTER ////////////////////////////////////-->
<footer class="footer static-bottom footer-dark footer-custom-class" data-midnight=default>
    <div class=container>
        <div class="footer-wrapper mx-auto text-center">
            <div class="footer-title mb-5 animated" data-animation=fadeInUpShorter data-animation-delay="0.2s">Stay updated with us</div>
            <p class="subscribe-desc mb-4 animated" data-animation=fadeInUpShorter data-animation-delay="0.4s">Follow us on the social links below and be the first to find about our latest products!</p>
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
            You must agree with our <a href="{{ route('policy.show') }}">{{ __('Privacy Policy') }}</a> and <a href="{{ route('terms.show') }}">{{ __('Terms of Service') }}</a>.
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js" integrity="sha512-CEiA+78TpP9KAIPzqBvxUv8hy41jyI3f2uHi7DGp/Y/Ka973qgSdybNegWFciqh6GrN2UePx2KkflnQUbUhNIA==" crossorigin="anonymous"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME JS-->
<script src="{{ asset('cryptoico/theme-assets/js/theme.js') }}"></script>
<!-- END CRYPTO JS-->
<!-- BEGIN PAGE LEVEL JS-->
<!-- END PAGE LEVEL JS-->
</body>
</html>
