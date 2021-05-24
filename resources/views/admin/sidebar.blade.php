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
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#"><i data-feather="package"></i><span>Plans</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="/plans">Plan List</a></li>
                            <li><a href="/plans/create">Create New</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#"><i data-feather="users"></i><span>Users</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="/users">All Users</a></li>
                            <li><a href="/users?type=blocked">Blocked</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#"><i data-feather="list"></i><span>Deposits</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="/deposits">All Deposits</a></li>
                            <li><a href="/settings/gateway">Gateways</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#"><i data-feather="list"></i><span>Withdraws</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="/withdraws">All Withdraws</a></li>
                            <li><a href="/settings/gateway">Gateways</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/reports"><i data-feather="clock"> </i><span>Reports</span></a></li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/partners"><i data-feather="command"> </i><span>Partners</span></a></li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#"><i data-feather="bell"></i><span>Notices</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="/notices">All Notices</a></li>
                            <li><a href="/notices/create">Create New</a></li>
                        </ul>
                    </li>
                    @if(config('telescope.enabled'))
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/telescope"><i data-feather="aperture"> </i><span>Telescope</span></a></li>
                    @endif
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
