@php
    $name = Auth::user()->name;
@endphp
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="/">
                    <b class="logo-abbr" style="width:50px !important">
                        <img src="{{ asset('images/logo.png') }}" alt=""  width="100%">
                    </b>
                    <span class="logo-compact">
                        <img src="{{ asset('images/logo.png') }}" alt="" width="80px">

                    </span>
                    <span class="brand-title">
                        <img src="{{ asset('images/logo.png') }}" alt="" width="80px">

                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">

                </div>
                <div class="header-right">
                    <ul class="clearfix">

                        {{-- <li class="icons dropdown d-none d-md-flex">
                            <a href="javascript:void(0)" class="log-user" data-toggle="dropdown">
                                <span>{{ __('SE.language') }}</span>
                                <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="{{ route('setLanguage', ['locale' => 'en']) }}">English</a></li>
                                        <li><a href="{{ route('setLanguage', ['locale' => 'ar']) }}">Arabic</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li> --}}
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>{{ $name }}
                                <img src="{{ asset('images/user/1.png') }}" height="40" width="40"
                                    alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="{{url('/profile-user')}}"><i class="icon-user"></i>
                                                <span>{{ __('SE.update_profile') }}</span></a>
                                        </li>
                                        {{-- <li>
                                            <a href="javascript:void()">
                                                <i class="icon-envelope-open"></i> <span>Inbox</span>
                                                <div class="badge gradient-3 badge-pill gradient-1">3</div>
                                            </a>
                                        </li> --}}

                                        <hr class="my-2">

                                        <li><a href="page-login.html"><span>  <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="btn bg-transparent"><i class="icon-key"></i> {{ __('SE.logout') }}</button>
                                        </form></span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->
