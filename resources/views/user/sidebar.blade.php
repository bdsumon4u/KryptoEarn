<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <a href="{{ route('dashboard') }}">
                <img class="img-fluid for-light" src="{{ asset('logo-circle.svg') }}" alt="">
                <img class="img-fluid for-dark" src="{{ asset('logo-circle.svg') }}" alt="">
                <strong class="ms-2 d-inline-block">{{ config('app.name') }}</strong>
            </a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{ route('dashboard') }}"><img class="img-fluid" src="{{ asset('logo-circle.svg') }}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="{{ route('dashboard') }}">
                            <img class="img-fluid" src="{{ asset('logo-circle.svg') }}" alt="">
                        </a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-8">Applications</h6>
                            <p class="lan-9">Ready to use Apps</p>
                        </div>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/plans"><i data-feather="arrow-up-circle"> </i><span>Upgrade Plan</span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/tasks"><i data-feather="activity"> </i><span>Tasks</span><label class="badge badge-primary">{{ auth()->user()->task_remaining }}</label></a></li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#"><i data-feather="dollar-sign"></i><span>Vouchers</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="/vouchers">List</a></li>
                            <li><a href="/vouchers/redeem">Redeem</a></li>
                            <li><a href="/vouchers/create">Create New</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/wallet"><i data-feather="credit-card"> </i><span>Wallet</span></a></li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#"><i data-feather="upload"></i><span>Deposits</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="/deposits">List</a></li>
                            <li><a href="/deposits/create">Deposit Now</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#"><i data-feather="download"></i><span>Withdraws</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="/withdraws">List</a></li>
                            <li><a href="/withdraws/create">Withdraw Now</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/support"><i data-feather="coffee"> </i><span>Support Ticket</span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/partners"><i data-feather="award"> </i><span>Our Partners</span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/referrals"><i data-feather="link"> </i><span>My Referrals</span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/partners/create"><i data-feather="globe"> </i><span>Partner With Us</span></a></li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
