<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <!-- <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template/index.html">
                <span class="brand-logo">
                        <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <g id="Group" transform="translate(400.000000, 178.000000)">
                                        <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                        <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                        <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                        <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <h2 class="brand-text">{{ env('APP_NAME') }}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul> -->
      <ul class="nav navbar-nav flex-row align-items-center">
    <li class="nav-item me-auto">
        <a class="navbar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}" style="padding: 1.5rem; text-decoration: none;">
            <!-- Logo Only -->
            <div class="logo-icon d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); border-radius: 12px; box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3); transition: all 0.3s ease;">
                <img src="{{ asset('images/school-vehicle-logo.svg') }}" alt="School Vehicle Management Logo" style="width: 32px; height: 32px; filter: brightness(0) invert(1);" />
            </div>
        </a>
    </li>
</ul>


    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" style="margin-top: 34px;">
            <!-- Dashboard -->
            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>

            <!-- School Management Section -->
            <li class=" navigation-header">
                <span data-i18n="School Management">School Management</span>
                <i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.school.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.school.index') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="School">School Details</span>
                </a>
            </li>

            <!-- People Management Section -->
            <li class=" navigation-header">
                <span data-i18n="People Management">People Management</span>
                <i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.guardians.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.guardians.index') }}">
                    <i data-feather='users'></i>
                    <span class="menu-title text-truncate" data-i18n="Guardians">Guardians</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.students.index') }}">
                    <i data-feather='user'></i>
                    <span class="menu-title text-truncate" data-i18n="Students">Students</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.drivers.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.drivers.index') }}">
                    <i data-feather='user-check'></i>
                    <span class="menu-title text-truncate" data-i18n="Drivers">Drivers</span>
                </a>
            </li>

            <!-- Transportation Management Section -->
            <li class=" navigation-header">
                <span data-i18n="Transportation">Transportation</span>
                <i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.vehicles.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.vehicles.index') }}">
                    <i data-feather='truck'></i>
                    <span class="menu-title text-truncate" data-i18n="Vehicles">Vehicles</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.routes.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.routes.index') }}">
                    <i data-feather='map'></i>
                    <span class="menu-title text-truncate" data-i18n="Routes">Routes</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.trips.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.trips.index') }}">
                    <i data-feather='navigation'></i>
                    <span class="menu-title text-truncate" data-i18n="Trips">Trips</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->

<style>
    /* Enhanced Sidebar Logo Styling - Logo Only */
    .navbar-brand:hover .logo-icon {
        transform: scale(1.1);
        box-shadow: 0 6px 25px rgba(99, 102, 241, 0.5) !important;
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%) !important;
    }
    
    .navbar-brand {
        transition: all 0.3s ease;
        width: 100%;
    }
    
    .navbar-brand:hover {
        text-decoration: none !important;
    }
    
    .logo-icon {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .logo-icon:hover {
        transform: scale(1.05);
    }
</style>
