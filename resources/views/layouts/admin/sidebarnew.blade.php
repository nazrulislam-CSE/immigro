<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
<div class="sticky">
    <aside class="app-sidebar sidebar-scroll">
        <div class="main-sidebar-header active">
            <a class="desktop-logo logo-light active" href="{{ route('user.home') }}">
                <h3 class="text-uppercase font-weight-bolder text-center">{{ get_setting('site_name')->value ?? '' }}
                </h3>
            </a>
        </div>
        <div class="main-sidemenu">
            <div class="main-sidebar-loggedin">
                <div class="app-sidebar__user">
                    <div class="dropdown user-pro-body text-center">
                        <div class="user-pic">
                            <img src="{{ !empty(Auth::guard('admin')->user()->image) ? url('upload/admin_images/' . Auth::guard('admin')->user()->image) : url('dashboard/img/avatar5.png') }}"
                                alt="user-img" class="rounded-circle mCS_img_loaded">
                        </div>
                        <div class="user-info">
                            <h6 class=" mb-0 text-dark">{{ Auth::guard('admin')->user()->name }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar-navs">
                <ul class="nav  nav-pills-circle">
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                        data-bs-original-title="Settings" aria-describedby="tooltip365540">
                        <a href="{{ route('admin.settings.index') }}" class="nav-link text-center m-2">
                            <i class="fe fe-settings"></i>
                        </a>
                    </li>
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                        data-bs-original-title="Followers">
                        <a href="{{ route('admin.profile.view') }}" class="nav-link text-center m-2">
                            <i class="fe fe-user"></i>
                        </a>
                    </li>
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                        data-bs-original-title="Logout">
                        <a class="nav-link text-center m-2" href="{{ route('admin.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fe fe-power"></i>
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg>
            </div>
            <ul class="side-menu ">
                {{-- Dashboard --}}
                @can('view Dashboard', 'admin')
                    <li class="slide">
                        <a class="side-menu__item {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.admin.home') }}">
                            <i class="side-menu__icon fas fa-th-large"></i>
                            <span class="side-menu__label">Dashboard</span>
                        </a>
                    </li>
                @endcan

                {{-- Visitors Module --}}
                @canany(['view Visitors', 'create Visitors', 'edit Visitors', 'delete Visitors'], 'admin')
                    <li class="slide">
                        <a class="side-menu__item {{ Request::is('admin/visitor*') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-store-alt"></i>
                            <span class="side-menu__label">Visitors</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Visitors</a></li>
                            @can('create Visitors', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/visitor/create') ? 'active' : '' }}"
                                        href="{{ route('admin.visitor.create') }}">Visitors Add</a>
                                </li>
                            @endcan
                            @can('view Visitors', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/visitor/index') ? 'active' : '' }}"
                                        href="{{ route('admin.visitor.index') }}">Visitors List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Clients Module --}}
                @canany(['view Clients', 'create Clients', 'edit Clients', 'delete Clients'], 'admin')
                    <li class="slide">
                        <a class="side-menu__item {{ Request::is('admin/client*') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-store-alt"></i>
                            <span class="side-menu__label">Clients</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Clients</a></li>
                            @can('view Clients', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/client/index') ? 'active' : '' }}"
                                        href="{{ route('admin.client.index') }}">Clients List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Agents Module --}}
                @canany(['view Agents', 'create Agents', 'edit Agents', 'delete Agents'], 'admin')
                    <li class="slide">
                        <a class="side-menu__item {{ Request::is('admin/agent*') ? 'active' : '' }}" data-bs-toggle="slide"
                            href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-store-alt"></i>
                            <span class="side-menu__label">Agents</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Agents</a></li>
                            @can('view Agents', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/agent/index') ? 'active' : '' }}"
                                        href="{{ route('admin.agent.index') }}">Agents List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Suppliers Module --}}
                @canany(['view Suppliers', 'create Suppliers', 'edit Suppliers', 'delete Suppliers', 'view supplier payments'], 'admin')
                    <li class="slide">
                        <a class="side-menu__item {{ Request::is('admin/supplier*') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-store-alt"></i>
                            <span class="side-menu__label">Suppliers</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Suppliers</a></li>
                            @can('view Suppliers', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/supplier/index') ? 'active' : '' }}"
                                        href="{{ route('admin.supplier.index') }}">Suppliers List</a>
                                </li>
                            @endcan
                            @can('view supplier payments', 'admin')
                                <li>
                                    <a class="slide-item" href="{{ route('admin.supplier-payment.index') }}">Suppliers Payments</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Invoices Module --}}
                @canany(['view Invoices', 'create Invoices', 'edit Invoices', 'delete Invoices'], 'admin')
                    <li class="slide">
                        <a class="side-menu__item {{ Request::is('admin/invoice*') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-store-alt"></i>
                            <span class="side-menu__label">Invoices</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Invoices</a></li>
                            @can('view Invoices', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/invoice/index') ? 'active' : '' }}"
                                        href="{{ route('admin.invoice.index') }}">Invoices List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Passports Module --}}
                @canany(['view Passports', 'create Passports', 'edit Passports', 'delete Passports'], 'admin')
                    <li class="slide">
                        <a class="side-menu__item {{ Request::is('admin/passport*') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-store-alt"></i>
                            <span class="side-menu__label">Passports</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Passports</a></li>
                            @can('view Passports', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/passport/index') ? 'active' : '' }}"
                                        href="{{ route('admin.passport.index') }}">Passports List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Refunds Module --}}
                @canany(['view Refunds', 'create Refunds', 'edit Refunds', 'delete Refunds'], 'admin')
                    <li class="slide">
                        <a class="side-menu__item {{ Request::is('admin/refund*') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-store-alt"></i>
                            <span class="side-menu__label">Refunds</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Refunds</a></li>
                            @can('view Refunds', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/refund/index') ? 'active' : '' }}"
                                        href="{{ route('admin.refund.index') }}">Refunds List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Staff Module --}}
                @canany(['view Staff', 'create Staff', 'edit Staff', 'delete Staff', 'view staff payments', 'view staff attendance'], 'admin')
                    <li class="slide">
                        <a class="side-menu__item {{ Request::is('admin/staff*') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-store-alt"></i>
                            <span class="side-menu__label">Staff</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Staff</a></li>
                            @can('view Staff', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/staff/index') ? 'active' : '' }}"
                                        href="{{ route('admin.staff.index') }}">Staff List</a>
                                </li>
                            @endcan
                            @can('view staff payments', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/staff/payment/index') ? 'active' : '' }}"
                                        href="{{ route('admin.staff.payment.index') }}">Staff Payment</a>
                                </li>
                            @endcan
                            @can('view staff attendance', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/staff/attendance/index') ? 'active' : '' }}"
                                        href="{{ route('admin.staff.attendance.index') }}">Staff Attendance</a>
                                </li>
                            @endcan
                            @canany(['view Staff', 'create Staff', 'edit Staff', 'delete Staff'], 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/staff/permissions*') ? 'active' : '' }}"
                                        href="{{ route('admin.staff.permissions.index') }}">Staff Permissions</a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany

                {{-- SMS Module (no permissions defined in seeder) --}}
                @canany(['view SMS', 'create SMS', 'edit SMS', 'delete SMS'], 'admin')
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-store-alt"></i>
                            <span class="side-menu__label">SMS</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">SMS</a></li>
                            @can('create SMS', 'admin')
                                <li><a class="slide-item" href="#">SMS Add</a></li>
                            @endcan
                            @can('view SMS', 'admin')
                                <li><a class="slide-item" href="#">SMS List</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Sections Module --}}
                @canany(['view Sections', 'create Sections', 'edit Sections', 'delete Sections'], 'admin')
                    <li class="slide {{ Request::is('admin/sections*') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-store-alt"></i>
                            <span class="side-menu__label">Sections</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Sections</a></li>
                            @can('create Sections', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/sections/create') ? 'active' : '' }}"
                                        href="{{ route('admin.section.create') }}">Section Add</a>
                                </li>
                            @endcan
                            @can('view Sections', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/sections/index') ? 'active' : '' }}"
                                        href="{{ route('admin.section.index') }}">Section List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Sliders Module --}}
                @canany(['view Sliders', 'create Sliders', 'edit Sliders', 'delete Sliders'], 'admin')
                    <li class="slide {{ Request::is('admin/slider*') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-store-alt"></i>
                            <span class="side-menu__label">Sliders</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Slider</a></li>
                            @can('create Sliders', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/slider/create') ? 'active' : '' }}"
                                        href="{{ route('admin.slider.create') }}">Slider Add</a>
                                </li>
                            @endcan
                            @can('view Sliders', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/slider/index') ? 'active' : '' }}"
                                        href="{{ route('admin.slider.index') }}">Slider List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- About Module --}}
                @canany(['view About', 'create About', 'edit About', 'delete About'], 'admin')
                    <li class="slide {{ Request::is('admin/about*') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-store-alt"></i>
                            <span class="side-menu__label">About</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">About</a></li>
                            @can('view About', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/about/index') ? 'active' : '' }}"
                                        href="{{ route('admin.about.index') }}">About List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Pages Module --}}
                @canany(['view Pages', 'create Pages', 'edit Pages', 'delete Pages'], 'admin')
                    <li class="slide {{ Request::is('admin/pages*') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-building"></i>
                            <span class="side-menu__label">Pages</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Pages</a></li>
                            @can('create Pages', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/pages/create') ? 'active' : '' }}"
                                        href="{{ route('admin.page.create') }}">Pages Add</a>
                                </li>
                            @endcan
                            @can('view Pages', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/pages/index') ? 'active' : '' }}"
                                        href="{{ route('admin.page.index') }}">Pages List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Menu Builder Module --}}
                @canany(['view Menu Builder', 'create Menu Builder', 'edit Menu Builder', 'delete Menu Builder'], 'admin')
                    <li class="slide {{ Request::is('admin/menus*') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-vote-yea"></i>
                            <span class="side-menu__label">Menu Builder</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Menu Builder</a></li>
                            @can('view Menu Builder', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/menuBuilder') ? 'active' : '' }}"
                                        href="{{ route('admin.menuBuilder') }}">Mange Menu Builder</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Teams Module --}}
                @canany(['view Teams', 'create Teams', 'edit Teams', 'delete Teams'], 'admin')
                    <li class="slide {{ Request::is('admin/teams*') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-users"></i>
                            <span class="side-menu__label">Teams</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Teams</a></li>
                            @can('create Teams', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/teams/create') ? 'active' : '' }}"
                                        href="{{ route('admin.team.create') }}">Team Add</a>
                                </li>
                            @endcan
                            @can('view Teams', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/teams/list') ? 'active' : '' }}"
                                        href="{{ route('admin.team.index') }}">Team List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Partners Module --}}
                @canany(['view Partners', 'create Partners', 'edit Partners', 'delete Partners'], 'admin')
                    <li class="slide {{ Request::is('admin/partner*') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-users"></i>
                            <span class="side-menu__label">Partners</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Partners</a></li>
                            @can('create Partners', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/partner/create') ? 'active' : '' }}"
                                        href="{{ route('admin.partner.create') }}">Partner Add</a>
                                </li>
                            @endcan
                            @can('view Partners', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/partner/list') ? 'active' : '' }}"
                                        href="{{ route('admin.partner.index') }}">Partner List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Testimonials Module --}}
                @canany(['view Testimonials', 'create Testimonials', 'edit Testimonials', 'delete Testimonials'], 'admin')
                    <li class="slide {{ Request::is('admin/testimonials*') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-users"></i>
                            <span class="side-menu__label">Testimonials</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Testimonials</a></li>
                            @can('create Testimonials', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/testimonials/create') ? 'active' : '' }}"
                                        href="{{ route('admin.testimonial.create') }}">Testimonials Add</a>
                                </li>
                            @endcan
                            @can('view Testimonials', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/testimonials/index') ? 'active' : '' }}"
                                        href="{{ route('admin.testimonial.index') }}">Testimonials List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Counters Module --}}
                @canany(['view Counters', 'create Counters', 'edit Counters', 'delete Counters'], 'admin')
                    <li class="slide {{ Request::is('admin/counters*') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-building"></i>
                            <span class="side-menu__label">Counters</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Counters</a></li>
                            @can('create Counters', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/counter/create') ? 'active' : '' }}"
                                        href="{{ route('admin.counter.create') }}">Counter Add</a>
                                </li>
                            @endcan
                            @can('view Counters', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/counter/store') ? 'active' : '' }}"
                                        href="{{ route('admin.counter.index') }}">Counter List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Services Module --}}
                @canany(['view Services', 'create Services', 'edit Services', 'delete Services'], 'admin')
                    <li class="slide {{ Request::is('admin/service*') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa fa-ambulance"></i>
                            <span class="side-menu__label">Services</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Services</a></li>
                            @can('create Services', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/service/create') ? 'active' : '' }}"
                                        href="{{ route('admin.service.create') }}">Service Add</a>
                                </li>
                            @endcan
                            @can('view Services', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/service/store') ? 'active' : '' }}"
                                        href="{{ route('admin.service.index') }}">Service List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Gallery Module --}}
                @canany(['view Gallery', 'create Gallery', 'edit Gallery', 'delete Gallery'], 'admin')
                    <li class="slide {{ Request::is('admin/gallery*') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa fa-ambulance"></i>
                            <span class="side-menu__label">Gallery</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Gallery</a></li>
                            @can('create Gallery', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/gallery/create') ? 'active' : '' }}"
                                        href="{{ route('admin.gallery.create') }}">Gallery Add</a>
                                </li>
                            @endcan
                            @can('view Gallery', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/gallery/store') ? 'active' : '' }}"
                                        href="{{ route('admin.gallery.index') }}">Gallery List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Advance Settings Module --}}
                @canany(['view Advance Settings', 'create Advance Settings', 'edit Advance Settings', 'delete Advance Settings'], 'admin')
                    <li class="slide {{ Request::is('admin/settings*') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                            <i class="side-menu__icon fas fa-cog"></i>
                            <span class="side-menu__label">Advance Settings</span>
                            <i class="angle fe fe-chevron-down hor-angle"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">Advance Settings</a></li>
                            @can('view Advance Settings', 'admin')
                                <li>
                                    <a class="slide-item {{ Request::is('admin/settings/index') ? 'active' : '' }}"
                                        href="{{ route('admin.settings.index') }}">Manage Setting</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

            </ul>

            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg>
            </div>
        </div>
    </aside>
</div>