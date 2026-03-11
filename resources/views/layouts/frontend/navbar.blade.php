@php
    $menuitems = App\Models\Menuitem::with(['subMenus.childMenus'])
        ->whereNull('parent_id')
        ->whereHas('get_menu', function ($query) {
            $query->where('location', 'main_header');
        })
        ->orderby('position', 'asc')
        ->get();
    $currentUrl = request()->url();
@endphp
<header class="main-header header-style-one">
    <!-- Header Top -->
    <div class="header-top">
        <div class="inner-container">

            <div class="top-left">
                <!-- Info List -->
                <ul class="list-style-one">
                    <li><i class="fa fa-envelope"></i> <a
                            href="mailto:{{ get_setting('email')->value ?? '' }}">{{ get_setting('email')->value ?? '' }}</a>
                    </li>
                    <li><i class="fa fa-map-marker"></i> {{ get_setting('business_address')->value ?? '' }}</li>
                    <li><i class="fa fa-clock"></i> {{ get_setting('business_hours')->value ?? '' }}</li>
                </ul>
            </div>

            <div class="top-right">
                <ul class="social-icon-one">
                    <li><a target="_blank" href="{{ get_setting('facebook_url')->value ?? '' }}"><span
                                class="fab fa-facebook-f"></span></a></li>
                    <li><a target="_blank" href="{{ get_setting('pinterest_url')->value ?? '' }}"><span
                                class="fab fa-pinterest-p"></span></a></li>
                    <li><a target="_blank" href="{{ get_setting('instagram_url')->value ?? '' }}"><span
                                class="fab fa-instagram"></span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Header Top -->

    <!-- Header Lower -->
    <div class="header-lower">
        <!-- Main box -->
        <div class="main-box">
            <div class="logo-box">
                <div class="logo"><a href="{{ route('frontend.home') }}"><img
                            src="{{ asset(get_setting('site_logo')->value ?? 'frontend/images/logo.png') }}"
                            alt="" title=""></a>
                </div>
            </div>

            @php
                $currentUrl = request()->path(); // or use request()->url() or Route::currentRouteName() based on your routes
            @endphp
            <!--Nav Box-->
            <div class="nav-outer">

                <nav class="nav main-menu">
                    <ul class="navigation">
                        @if (count($menuitems) == 0)
                            @for ($i = 1; $i < 6; $i++)
                                <li><a href="#">Default Menu {{ $i }}</a></li>
                            @endfor
                        @endif
                        @foreach ($menuitems as $menuitem)
                            @php
                                $isActiveParent = false;
                                // Check if the parent menu is active
                                if ($menuitem->url == 'home-page' && request()->routeIs('frontend.home')) {
                                    $isActiveParent = true;
                                } elseif (request()->is("menu/{$menuitem->url}")) {
                                    $isActiveParent = true;
                                } else {
                                    // Check if any child submenu is active
                                    foreach ($menuitem->subMenus as $subMenu) {
                                        if (request()->is("menu/{$subMenu->url}")) {
                                            $isActiveParent = true;
                                            break;
                                        }
                                    }
                                }
                            @endphp
                            <li class="{{ $isActiveParent ? 'active show' : '' }}">
                                @if ($menuitem->url == 'home-page')
                                    <a href="{{ route('frontend.home') }}">{{ $menuitem->title ?? '' }}</a>
                                @else
                                    <a
                                        href="{{ route('menu.page', $menuitem->url) }}">{{ $menuitem->title ?? '' }}</a>
                                @endif
                                @if (count($menuitem->subMenus) > 0)
                                    <ul>
                                        @foreach ($menuitem->subMenus as $subMenu)
                                            <li class="{{ request()->is("menu/{$subMenu->url}") ? 'active' : '' }}"><a
                                                    href="{{ route('menu.page', $subMenu->url) }}">{{ $subMenu->title ?? '' }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        <li>
                            <a href="/admin/login">Login</a>
                        </li>
                    </ul>
                </nav>
                <!-- Main Menu End-->

                <div class="outer-box">
                    <a href="tel:{{ get_setting('phone')->value ?? '' }}" class="info-btn">
                        <img src="{{ asset('frontend/images/icons/icon-phone.png') }}" alt="" class="icon">
                        <small>Call Anytime</small>
                        <strong>{{ get_setting('phone')->value ?? '' }}</strong>
                    </a>

                    <div class="ui-btn-outer">
                        <button class="ui-btn ui-btn search-btn">
                            <span class="icon lnr lnr-icon-search"></span>
                        </button>
                    </div>

                    <a href="#" class="theme-btn btn-style-one"><span class="btn-title">Book
                            Consultation</span></a>

                    <!-- Mobile Nav toggler -->
                    <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Lower -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>

        <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
        <nav class="menu-box">
            <div class="upper-box">
                <div class="nav-logo"><a href="{{ route('home') }}"><img src="{{ asset(get_setting('site_logo')->value ?? 'frontend/images/logo.png') }}"
                            alt="" title=""></a>
                </div>
                <div class="close-btn"><i class="icon fa fa-times"></i></div>
            </div>

            <ul class="navigation clearfix">
                <!--Keep This Empty / Menu will come through Javascript-->
            </ul>
            <ul class="contact-list-one">
                <li>
                    <!-- Contact Info Box -->
                    <div class="contact-info-box">
                        <i class="icon lnr-icon-phone-handset"></i>
                        <span class="title">Call Now</span>
                        <a href="tel:{{ get_setting('phone')->value ?? '' }}">{{ get_setting('phone')->value ?? '' }}</a>
                    </div>
                </li>
                <li>
                    <!-- Contact Info Box -->
                    <div class="contact-info-box">
                        <span class="icon lnr-icon-envelope1"></span>
                        <span class="title">Send Email</span>
                        <a href="mailto:{{ get_setting('email')->value ?? '' }}">{{ get_setting('email')->value ?? '' }}</a>
                    </div>
                </li>
                <li>
                    <!-- Contact Info Box -->
                    <div class="contact-info-box">
                        <span class="icon lnr-icon-clock"></span>
                        <span class="title">Send Email</span>
                        {{ get_setting('business_hours')->value ?? '' }}
                    </div>
                </li>
            </ul>


            <ul class="social-links">
                <li><a target="_blank" href="{{ get_setting('facebook_url')->value ?? '' }}"><i class="fab fa-facebook-f"></i></a></li>
                <li><a target="_blank" href="{{ get_setting('pinterest_url')->value ?? '' }}"><i class="fab fa-pinterest"></i></a></li>
                <li><a target="_blank" href="{{ get_setting('instagram_url')->value ?? '' }}"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </nav>
    </div><!-- End Mobile Menu -->

    <!-- Header Search -->
    <div class="search-popup">
        <span class="search-back-drop"></span>
        <button class="close-search"><span class="fa fa-times"></span></button>

        <div class="search-inner">
            <form method="post" action="#">
                <div class="form-group">
                    <input type="search" name="search-field" value="" placeholder="Search..." required="">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Header Search -->

    <!-- Sticky Header  -->
    <div class="sticky-header">
        <div class="auto-container">
            <div class="inner-container">
                <!--Logo-->
                <div class="logo">
                    <a href="{{ route('frontend.home') }}" title=""><img src="{{ asset(get_setting('site_logo')->value ?? 'frontend/images/logo.png') }}"
                            alt="" title=""></a>
                </div>

                <!--Right Col-->
                <div class="nav-outer">
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <div class="navbar-collapse show collapse clearfix">
                            <ul class="navigation clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </ul>
                        </div>
                    </nav><!-- Main Menu End-->

                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                </div>
            </div>
        </div>
    </div><!-- End Sticky Menu -->
</header>
