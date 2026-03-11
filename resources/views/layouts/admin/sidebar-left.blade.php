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

            @php
                $admin = Auth::guard('admin')->user();
                $isSuperAdmin = $admin && $admin->hasRole('Super Admin');
            @endphp

            <ul class="side-menu ">
                {{-- Dashboard --}}
                @if($isSuperAdmin || $admin->can('view Dashboard'))
                <li class="slide">
                    <a class="side-menu__item {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.admin.home') }}"><i class="side-menu__icon fas fa-th-large"></i><span
                            class="side-menu__label">Dashboard</span></a>
                </li>
                @endif

                {{-- Visitors Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Visitors', 'create Visitors', 'edit Visitors', 'delete Visitors']))
                <li class="slide">
                    <a class="side-menu__item {{ Request::is('admin/visitor*') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">Visitors</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Visitors</a></li>
                        @if($isSuperAdmin || $admin->can('create Visitors'))
                        <li><a class="slide-item {{ Request::is('admin/visitor/create') ? 'active' : '' }}"
                                href="{{ route('admin.visitor.create') }}">Visitors Add</a></li>
                        @endif
                        @if($isSuperAdmin || $admin->can('view Visitors'))
                        <li><a class="slide-item {{ Request::is('admin/visitor/index') ? 'active' : '' }}"
                                href="{{ route('admin.visitor.index') }}">Visitors List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Clients Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Clients', 'create Clients', 'edit Clients', 'delete Clients']))
                <li class="slide">
                    <a class="side-menu__item {{ Request::is('admin/client*') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">Clients</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Clients</a></li>
                        @if($isSuperAdmin || $admin->can('view Clients'))
                        <li><a class="slide-item {{ Request::is('admin/client/index') ? 'active' : '' }}"
                                href="{{ route('admin.client.index') }}">Clients List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Agents Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Agents', 'create Agents', 'edit Agents', 'delete Agents']))
                <li class="slide">
                    <a class="side-menu__item {{ Request::is('admin/agent*') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">Agents</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Agents</a></li>
                        @if($isSuperAdmin || $admin->can('view Agents'))
                        <li><a class="slide-item {{ Request::is('admin/agent/index') ? 'active' : '' }}"
                                href="{{ route('admin.agent.index') }}">Agents List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Suppliers Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Suppliers', 'create Suppliers', 'edit Suppliers', 'delete Suppliers', 'view supplier payments']))
                <li class="slide">
                    <a class="side-menu__item {{ Request::is('admin/supplier*') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">Suppliers</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Suppliers</a></li>
                        @if($isSuperAdmin || $admin->can('view Suppliers'))
                        <li><a class="slide-item {{ Request::is('admin/supplier/index') ? 'active' : '' }}"
                                href="{{ route('admin.supplier.index') }}">Suppliers List</a></li>
                        @endif
                        @if($isSuperAdmin || $admin->can('view supplier payments'))
                        <li><a class="slide-item" href="{{ route('admin.supplier-payment.index') }}">Suppliers
                                Payments</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Invoices Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Invoices', 'create Invoices', 'edit Invoices', 'delete Invoices']))
                <li class="slide">
                    <a class="side-menu__item {{ Request::is('admin/invoice*') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">Invoices</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Invoices</a></li>
                        @if($isSuperAdmin || $admin->can('view Invoices'))
                        <li><a class="slide-item {{ Request::is('admin/invoice/index') ? 'active' : '' }}"
                                href="{{ route('admin.invoice.index') }}">Invoices List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Passports Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Passports', 'create Passports', 'edit Passports', 'delete Passports']))
                <li class="slide">
                    <a class="side-menu__item {{ Request::is('admin/passport*') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">Passports</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Passports</a></li>
                        @if($isSuperAdmin || $admin->can('view Passports'))
                        <li><a class="slide-item {{ Request::is('admin/passport/index') ? 'active' : '' }}"
                                href="{{ route('admin.passport.index') }}">Passports List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Refunds Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Refunds', 'create Refunds', 'edit Refunds', 'delete Refunds']))
                <li class="slide">
                    <a class="side-menu__item {{ Request::is('admin/refund*') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">Refunds</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Refunds</a></li>
                        @if($isSuperAdmin || $admin->can('view Refunds'))
                        <li><a class="slide-item {{ Request::is('admin/refund/index') ? 'active' : '' }}"
                                href="{{ route('admin.refund.index') }}">Refunds List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Staff Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Staff', 'create Staff', 'edit Staff', 'delete Staff', 'view staff payments', 'view staff attendance']))
                <li class="slide">
                    <a class="side-menu__item {{ Request::is('admin/staff*') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">Staff</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Staff</a></li>
                        @if($isSuperAdmin || $admin->can('view Staff'))
                        <li><a class="slide-item {{ Request::is('admin/staff/index') ? 'active' : '' }}"
                                href="{{ route('admin.staff.index') }}">Staff List</a></li>
                        @endif
                        @if($isSuperAdmin || $admin->can('view staff payments'))
                        <li><a class="slide-item {{ Request::is('admin/staff/payment/index') ? 'active' : '' }}"
                                href="{{ route('admin.staff.payment.index') }}">Staff Payment</a></li>
                        @endif
                        @if($isSuperAdmin || $admin->can('view staff attendance'))
                        <li><a class="slide-item {{ Request::is('admin/staff/attendance/index') ? 'active' : '' }}"
                                href="{{ route('admin.staff.attendance.index') }}">Staff Attendance</a></li>
                        @endif
                        @if($isSuperAdmin || $admin->canAny(['view Staff', 'create Staff', 'edit Staff', 'delete Staff']))
                        <li><a class="slide-item {{ Request::is('admin/staff/permissions*') ? 'active' : '' }}"
                                href="{{ route('admin.staff.permissions.index') }}">Staff Permissions</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- SMS Module --}}
                {{-- If you have permissions for SMS, add them to seeder. For now, we assume no permissions exist. --}}
                @if($isSuperAdmin)
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">SMS</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">SMS</a></li>
                        <li><a class="slide-item" href="#">SMS Add</a></li>
                        <li><a class="slide-item" href="#">SMS List</a></li>
                    </ul>
                </li>
                @endif

                 {{-- Training Section --}}
                @if($isSuperAdmin || $admin->canAny(['view Gallery', 'create Gallery', 'edit Gallery', 'delete Gallery']))
                <li class="slide {{ Request::is('admin/training*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa fa-ambulance"></i>
                        <span class="side-menu__label">Training</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Training</a></li>
                        @if($isSuperAdmin || $admin->can('view Gallery'))
                        <li><a class="slide-item {{ Request::is('admin/training/store') ? 'active' : '' }}"
                                href="{{ route('admin.training.index') }}">Training List</a></li>
                        @endif
                    </ul>
                </li>
                @endif
                
                {{-- country Section --}}
                @if($isSuperAdmin || $admin->canAny(['view Gallery', 'create Gallery', 'edit Gallery', 'delete Gallery']))
                <li class="slide {{ Request::is('admin/country*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa fa-ambulance"></i>
                        <span class="side-menu__label">Country</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Country</a></li>
                        @if($isSuperAdmin || $admin->can('view Gallery'))
                        <li><a class="slide-item {{ Request::is('admin/country/store') ? 'active' : '' }}"
                                href="{{ route('admin.country.index') }}">Country List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Sections Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Sections', 'create Sections', 'edit Sections', 'delete Sections']))
                <li class="slide {{ Request::is('admin/sections*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">Sections</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Sections</a></li>
                        @if($isSuperAdmin || $admin->can('create Sections'))
                        <li><a class="slide-item {{ Request::is('admin/sections/create') ? 'active' : '' }}"
                                href="{{ route('admin.section.create') }}">Section Add</a></li>
                        @endif
                        @if($isSuperAdmin || $admin->can('view Sections'))
                        <li><a class="slide-item {{ Request::is('admin/sections/index') ? 'active' : '' }}"
                                href="{{ route('admin.section.index') }}">Section List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Sliders Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Sliders', 'create Sliders', 'edit Sliders', 'delete Sliders']))
                <li class="slide {{ Request::is('admin/slider*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">Sliders</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Slider</a></li>
                        @if($isSuperAdmin || $admin->can('create Sliders'))
                        <li><a class="slide-item {{ Request::is('admin/slider/create') ? 'active' : '' }}"
                                href="{{ route('admin.slider.create') }}">Slider Add</a></li>
                        @endif
                        @if($isSuperAdmin || $admin->can('view Sliders'))
                        <li><a class="slide-item {{ Request::is('admin/slider/index') ? 'active' : '' }}"
                                href="{{ route('admin.slider.index') }}">Slider List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- About Module --}}
                @if($isSuperAdmin || $admin->canAny(['view About', 'create About', 'edit About', 'delete About']))
                <li class="slide {{ Request::is('admin/about*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-store-alt"></i>
                        <span class="side-menu__label">About</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">About</a></li>
                        @if($isSuperAdmin || $admin->can('view About'))
                        <li><a class="slide-item {{ Request::is('admin/about/index') ? 'active' : '' }}"
                                href="{{ route('admin.about.index') }}">About List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Pages Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Pages', 'create Pages', 'edit Pages', 'delete Pages']))
                <li class="slide {{ Request::is('admin/pages*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-building"></i>
                        <span class="side-menu__label">Pages</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Pages</a></li>
                        @if($isSuperAdmin || $admin->can('create Pages'))
                        <li><a class="slide-item {{ Request::is('admin/pages/create') ? 'active' : '' }}"
                                href="{{ route('admin.page.create') }}">Pages Add</a></li>
                        @endif
                        @if($isSuperAdmin || $admin->can('view Pages'))
                        <li><a class="slide-item {{ Request::is('admin/pages/index') ? 'active' : '' }}"
                                href="{{ route('admin.page.index') }}">Pages List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Menu Builder Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Menu Builder', 'create Menu Builder', 'edit Menu Builder', 'delete Menu Builder']))
                <li class="slide {{ Request::is('admin/menus*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-vote-yea"></i>
                        <span class="side-menu__label">Menu Builder</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Menu Builder</a></li>
                        @if($isSuperAdmin || $admin->can('view Menu Builder'))
                        <li><a class="slide-item {{ Request::is('admin/menuBuilder') ? 'active' : '' }}"
                                href="{{ route('admin.menuBuilder') }}">Mange Menu Builder</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Teams Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Teams', 'create Teams', 'edit Teams', 'delete Teams']))
                <li class="slide {{ Request::is('admin/teams*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-users"></i>
                        <span class="side-menu__label">Teams</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Teams</a></li>
                        @if($isSuperAdmin || $admin->can('create Teams'))
                        <li><a class="slide-item {{ Request::is('admin/teams/create') ? 'active' : '' }}"
                                href="{{ route('admin.team.create') }}">Team Add</a></li>
                        @endif
                        @if($isSuperAdmin || $admin->can('view Teams'))
                        <li><a class="slide-item {{ Request::is('admin/teams/list') ? 'active' : '' }}"
                                href="{{ route('admin.team.index') }}">Team List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Partners Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Partners', 'create Partners', 'edit Partners', 'delete Partners']))
                <li class="slide {{ Request::is('admin/partner*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-users"></i>
                        <span class="side-menu__label">Partners</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Partners</a></li>
                        @if($isSuperAdmin || $admin->can('create Partners'))
                        <li><a class="slide-item {{ Request::is('admin/partner/create') ? 'active' : '' }}"
                                href="{{ route('admin.partner.create') }}">Partner Add</a></li>
                        @endif
                        @if($isSuperAdmin || $admin->can('view Partners'))
                        <li><a class="slide-item {{ Request::is('admin/partner/list') ? 'active' : '' }}"
                                href="{{ route('admin.partner.index') }}">Partner List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Testimonials Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Testimonials', 'create Testimonials', 'edit Testimonials', 'delete Testimonials']))
                <li class="slide {{ Request::is('admin/testimonials*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-users"></i>
                        <span class="side-menu__label">Testimonials</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Testimonials</a></li>
                        @if($isSuperAdmin || $admin->can('create Testimonials'))
                        <li><a class="slide-item {{ Request::is('admin/testimonials/create') ? 'active' : '' }}"
                                href="{{ route('admin.testimonial.create') }}">Testimonials Add</a></li>
                        @endif
                        @if($isSuperAdmin || $admin->can('view Testimonials'))
                        <li><a class="slide-item {{ Request::is('admin/testimonials/index') ? 'active' : '' }}"
                                href="{{ route('admin.testimonial.index') }}">Testimonials List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Counters Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Counters', 'create Counters', 'edit Counters', 'delete Counters']))
                <li class="slide {{ Request::is('admin/counters*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-building"></i>
                        <span class="side-menu__label">Counters</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Counters</a></li>
                        @if($isSuperAdmin || $admin->can('create Counters'))
                        <li><a class="slide-item {{ Request::is('admin/counter/create') ? 'active' : '' }}"
                                href="{{ route('admin.counter.create') }}">Counter Add</a></li>
                        @endif
                        @if($isSuperAdmin || $admin->can('view Counters'))
                        <li><a class="slide-item {{ Request::is('admin/counter/store') ? 'active' : '' }}"
                                href="{{ route('admin.counter.index') }}">Counter List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Services Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Services', 'create Services', 'edit Services', 'delete Services']))
                <li class="slide {{ Request::is('admin/service*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa fa-ambulance"></i>
                        <span class="side-menu__label">Services</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Services</a></li>
                        @if($isSuperAdmin || $admin->can('create Services'))
                        <li><a class="slide-item {{ Request::is('admin/service/create') ? 'active' : '' }}"
                                href="{{ route('admin.service.create') }}">Service Add</a></li>
                        @endif
                        @if($isSuperAdmin || $admin->can('view Services'))
                        <li><a class="slide-item {{ Request::is('admin/service/store') ? 'active' : '' }}"
                                href="{{ route('admin.service.index') }}">Service List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Gallery Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Gallery', 'create Gallery', 'edit Gallery', 'delete Gallery']))
                <li class="slide {{ Request::is('admin/gallery*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa fa-ambulance"></i>
                        <span class="side-menu__label">Gallery</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Gallery</a></li>
                        @if($isSuperAdmin || $admin->can('create Gallery'))
                        <li><a class="slide-item {{ Request::is('admin/gallery/create') ? 'active' : '' }}"
                                href="{{ route('admin.gallery.create') }}">Gallery Add</a></li>
                        @endif
                        @if($isSuperAdmin || $admin->can('view Gallery'))
                        <li><a class="slide-item {{ Request::is('admin/gallery/store') ? 'active' : '' }}"
                                href="{{ route('admin.gallery.index') }}">Gallery List</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- Advance Settings Module --}}
                @if($isSuperAdmin || $admin->canAny(['view Advance Settings', 'create Advance Settings', 'edit Advance Settings', 'delete Advance Settings']))
                <li class="slide {{ Request::is('admin/settings*') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="side-menu__icon fas fa-cog"></i>
                        <span class="side-menu__label">Advance Settings</span>
                        <i class="angle fe fe-chevron-down hor-angle"></i>
                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Advance Settings</a></li>
                        @if($isSuperAdmin || $admin->can('view Advance Settings'))
                        <li><a class="slide-item {{ Request::is('admin/settings/index') ? 'active' : '' }}"
                                href="{{ route('admin.settings.index') }}">Manage Setting</a></li>
                        @endif
                    </ul>
                </li>
                @endif
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