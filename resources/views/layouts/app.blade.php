<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="{{ app()->getLocale() }}" dir="{{ config('system.lang.' . app()->getLocale() . '.dir') }}"
    direction="{{ config('system.lang.' . app()->getLocale() . '.direction') }}"
    style="{{ config('system.lang.' . app()->getLocale() . '.style') }}">
<!--begin::Head-->

<head>
    <title>JPA Emirates - By MIE.Systems</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link
        href="{{ asset('assets/plugins/custom/datatables/datatables.bundle' . config('system.lang.' . app()->getLocale() . '.css') . '.css') }}"
        rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link
        href="{{ asset('assets/plugins/global/plugins' . $themeMode . '.bundle' . config('system.lang.' . app()->getLocale() . '.css') . '.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('assets/css/style' . $themeMode . '.bundle' . config('system.lang.' . app()->getLocale() . '.css') . '.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css" />
     @if ($themeMode == '.dark')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
    @endif

    <!--end::Global Stylesheets Bundle-->
    @livewireStyles
    @stack('style')
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="scroll-y header-fixed header-tablet-and-mobile-fixed  @if ($themeMode == '.dark') dark-mode @endif header-background-{{ $imageMode }}">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header bg-transparent header-background-{{ $imageMode }}">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex flex-stack">
                        <!--begin::Brand-->
                        <div class="d-flex align-items-center me-5 ms-3">
                            <!--begin::Aside toggle-->
                            <div class="d-lg-none btn btn-icon btn-active-color-white w-30px h-30px ms-n2 me-3"
                                id="kt_aside_toggle">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                            fill="black" />
                                        <path opacity="0.3"
                                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                            fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Aside  toggle-->
                            <!--begin::Logo-->
                            <a href="{{ route('home') }}">
                                <img alt="Logo" src="{{ asset('assets/media/logos/logo-white-trans-bg.png') }}"
                                    class="h-30px h-lg-40px" />
                            </a>
                            <!--end::Logo-->
                            <!--begin::Nav-->
                            <div class="ms-5 ms-md-10">
                                <!--begin::Toggle-->
                                <button type="button"
                                    class="btn btn-flex btn-active-color-white align-items-cenrer justify-content-center justify-content-md-between align-items-lg-cenrer flex-md-content-between bg-white bg-opacity-10 btn-color-gray-500 px-0 ps-md-6 pe-md-5 h-30px w-30px h-md-35px w-md-200px"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                    <span class="d-none d-md-inline">Dashboard</span>
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                    <span class="svg-icon svg-icon-4 ms-md-4 me-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--end::Toggle-->
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg fw-bold w-200px pb-3"
                                    data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content fs-7 text-dark fw-bolder px-3 py-4">Select department:
                                        </div>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator mb-3 opacity-75"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Accounting &amp; Finance</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Human Resources</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Marketing</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Matters1</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Nav-->
                        </div>
                        <!--end::Brand-->
                        <!--begin::Topbar-->
                        <div class="d-flex align-items-center flex-shrink-0">
                            @auth
                                <div class="d-flex align-items-center ms-1" id="kt_header_user_menu_toggle">
                                    <!--begin::User info-->
                                    <div class="btn btn-flex align-items-center bg-hover-white bg-hover-opacity-10 py-2 px-2 px-md-3"
                                        data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                        data-kt-menu-placement="bottom-end">
                                        <!--begin::Name-->
                                        <div
                                            class="d-none d-md-flex flex-column align-items-end justify-content-center me-2 me-md-4">

                                            <span
                                                class="text-white fs-8 fw-bold lh-1 mb-1">{{ Auth::user()->name }}</span>
                                            <span
                                                class="text-white fs-8 lh-1">{{ optional(Auth::user()->expert)->field }}</span>
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px symbol-md-40px">
                                            <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="image" />
                                        </div>
                                        <!--end::Symbol-->
                                    </div>
                                    <!--end::User info-->
                                    <!--begin::User account menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content d-flex align-items-center px-3">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-50px me-5">
                                                    <img alt="Logo"
                                                        src="{{ asset('assets/media/avatars/blank.png') }}" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Username-->
                                                <div class="d-flex flex-column">
                                                    <div class="fw-bolder d-flex align-items-center fs-5">
                                                        {{ Auth::user()->display_name }}
                                                        <span
                                                            class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">{{ optional(Auth::user()->expert)->category }}</span>
                                                    </div>
                                                    <a href="#"
                                                        class="fw-bold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                                                </div>
                                                <!--end::Username-->
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>
                                        <!--end::Menu separator-->
                                        {{-- <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="../../demo14/dist/account/overview.html" class="menu-link px-5">My
                                                Profile</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="../../demo14/dist/apps/projects/list.html" class="menu-link px-5">
                                                <span class="menu-text">My Projects</span>
                                                <span class="menu-badge">
                                                    <span
                                                        class="badge badge-light-danger badge-circle fw-bolder fs-7">3</span>
                                                </span>
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5" data-kt-menu-trigger="hover"
                                            data-kt-menu-placement="left-start">
                                            <a href="#" class="menu-link px-5">
                                                <span class="menu-title">My Subscription</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="../../demo14/dist/account/referrals.html"
                                                        class="menu-link px-5">Referrals</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="../../demo14/dist/account/billing.html"
                                                        class="menu-link px-5">Billing</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="../../demo14/dist/account/statements.html"
                                                        class="menu-link px-5">Payments</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="../../demo14/dist/account/statements.html"
                                                        class="menu-link d-flex flex-stack px-5">Statements
                                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                            data-bs-toggle="tooltip" title="View your statements"></i></a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu separator-->
                                                <div class="separator my-2"></div>
                                                <!--end::Menu separator-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content px-3">
                                                        <label
                                                            class="form-check form-switch form-check-custom form-check-solid">
                                                            <input class="form-check-input w-30px h-20px" type="checkbox"
                                                                value="1" checked="checked" name="notifications" />
                                                            <span
                                                                class="form-check-label text-muted fs-7">Notifications</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="../../demo14/dist/account/statements.html" class="menu-link px-5">My
                                                Statements</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5" data-kt-menu-trigger="hover"
                                            data-kt-menu-placement="left-start">
                                            <a href="#" class="menu-link px-5">
                                                <span class="menu-title position-relative">Language
                                                    <span
                                                        class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English
                                                        <img class="w-15px h-15px rounded-1 ms-2"
                                                            src="{{ asset('assets/media/flags/united-states.svg') }}"
                                                            alt="" /></span></span>
                                            </a>
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="../../demo14/dist/account/settings.html"
                                                        class="menu-link d-flex px-5 active">
                                                        <span class="symbol symbol-20px me-4">
                                                            <img class="rounded-1"
                                                                src="{{ asset('assets/media/flags/united-states.svg') }}"
                                                                alt="" />
                                                        </span>English</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="../../demo14/dist/account/settings.html"
                                                        class="menu-link d-flex px-5">
                                                        <span class="symbol symbol-20px me-4">
                                                            <img class="rounded-1"
                                                                src="{{ asset('assets/media/flags/spain.svg') }}"
                                                                alt="" />
                                                        </span>Spanish</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="../../demo14/dist/account/settings.html"
                                                        class="menu-link d-flex px-5">
                                                        <span class="symbol symbol-20px me-4">
                                                            <img class="rounded-1"
                                                                src="{{ asset('assets/media/flags/germany.svg') }}"
                                                                alt="" />
                                                        </span>German</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="../../demo14/dist/account/settings.html"
                                                        class="menu-link d-flex px-5">
                                                        <span class="symbol symbol-20px me-4">
                                                            <img class="rounded-1"
                                                                src="{{ asset('assets/media/flags/japan.svg') }}"
                                                                alt="" />
                                                        </span>Japanese</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="../../demo14/dist/account/settings.html"
                                                        class="menu-link d-flex px-5">
                                                        <span class="symbol symbol-20px me-4">
                                                            <img class="rounded-1"
                                                                src="{{ asset('assets/media/flags/france.svg') }}"
                                                                alt="" />
                                                        </span>French</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5 my-1">
                                            <a href="../../demo14/dist/account/settings.html" class="menu-link px-5">Account
                                                Settings</a>
                                        </div> --}}
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="menu-link btn w-100 ps-5 px-5">{{ __('app.sign_out') }}</button>
                                            </form>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <div class="menu-content px-5">
                                                <label class="form-check form-switch form-check-custom form-check-solid"
                                                    for="kt_user_menu_dark_mode_toggle">
                                                    <input class="form-check-input w-30px h-20px" type="checkbox"
                                                        id="darkMode" value="dark" name="mode" />
                                                    <span
                                                        class="form-check-label fw-bolder text-gray-600 fs-7">{{ __('app.dark-mode') }}</span>
                                                </label>
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::User account menu-->
                                </div>
                            @endauth
                            <!--end::User -->
                        </div>
                        <!--end::Topbar-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Aside-->
                    <div id="kt_aside" class="aside card" data-kt-drawer="true" data-kt-drawer-name="aside"
                        data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                        data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
                        data-kt-drawer-toggle="#kt_aside_toggle">
                        <!--begin::Aside menu-->
                        <div class="aside-menu flex-column-fluid px-5">
                            <!--begin::Aside Menu-->
                            <div class="hover-scroll-overlay-y my-5 pe-4 me-n4" id="kt_aside_menu_wrapper"
                                data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_aside_footer"
                                data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu"
                                data-kt-scroll-offset="{lg: '75px'}">
                                <!--begin::Menu-->
                                @include('layouts.main_menu')
                                <!--end::Menu-->
                                <!--end::Menu-->
                            </div>
                        </div>
                        <!--end::Aside menu-->
                        <!--begin::Footer-->
                        <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
                            <a href="../../demo14/dist/documentation/getting-started.html"
                                class="btn btn-bg-light btn-color-gray-500 btn-active-color-gray-900 w-100"
                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click"
                                title="200+ in-house components and 3rd-party plugins">
                                <span class="btn-label">Docs &amp; Components</span>
                                <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
                                <span class="svg-icon btn-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path opacity="0.3"
                                            d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z"
                                            fill="black" />
                                        <rect x="7" y="17" width="6" height="2" rx="1" fill="black" />
                                        <rect x="7" y="12" width="10" height="2" rx="1" fill="black" />
                                        <rect x="7" y="7" width="6" height="2" rx="1" fill="black" />
                                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Aside-->
                    <!--begin::Container-->
                    <div class="d-flex flex-column flex-column-fluid container-fluid">
                        <!--begin::Toolbar-->
                        <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
                            <!--begin::Page title-->
                            <div class="page-title d-flex flex-column me-3">
                                <!--begin::Title-->
                                <h1 class="d-flex text-white my-1 fs-3">
                                    {{ __('app.matters-management-system') }}</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                {{-- {{ Breadcrumbs::render(Route::currentRouteName(),$matter) }} --}}
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Post-->
                        <div class="content flex-column-fluid" id="kt_content">
                            <!--begin::Card-->
                            <!--begin::Alert-->
                            <!--end::Alert-->
                            @yield('content')
                            <!--end::Card-->
                        </div>
                        <!--end::Post-->
                        <!--begin::Footer-->
                        <div class="footer py-4 d-flex flex-column flex-md-row flex-stack" id="kt_footer">
                            <!--begin::Copyright-->
                            <div class="text-dark order-2 order-md-1">
                                <span class="text-muted fw-bold me-1">2022©</span>
                                <a href="https://mie.systems" target="_blank"
                                    class="text-gray-800 text-hover-primary">MIE.Systems</a>
                            </div>
                            <!--end::Copyright-->
                            <!--begin::Menu-->
                            {{-- <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                                <li class="menu-item">
                                    <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
                                </li>
                                <li class="menu-item">
                                    <a href="https://devs.keenthemes.com" target="_blank"
                                        class="menu-link px-2">Support</a>
                                </li>
                                <li class="menu-item">
                                    <a href="https://1.envato.market/EA4JP" target="_blank"
                                        class="menu-link px-2">Purchase</a>
                                </li>
                            </ul> --}}
                            <!--end::Menu-->
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Content wrapper-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                    fill="black" />
                <path
                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                    fill="black" />
            </svg>
        </span>
        <!--end::Svg Icon-->
    </div>
    <!--end::Scrolltop-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>

    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors Javascript-->
    {{-- <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/offer-a-deal/type.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/offer-a-deal/details.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/offer-a-deal/finance.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/offer-a-deal/complete.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/offer-a-deal/main.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <!--end::Page Custom Javascript--> --}}
    @livewireScripts
    @include('sweetalert::alert')
    <script>
        $(document).ready(function() {
            $('.modal').each(function() {
                var that = $(this);
                that.find('[data-control="select2"]').each(function() {
                    $(this).select2({
                        dropdownParent: that,
                    })
                })
            })
        });

        var setThemeMode = function(mode, cb) {

            localStorage.setItem('theme', mode);
            var date = new Date(Date.now() + 5 * 12 * 30 * 24 * 60 * 60 * 1000); // +2 day from now
            var options = {
                expires: date
            };
            KTCookie.set("themeMode", mode, options);

            // Load css file
            var loadCssFile = function(fileName, newFileName) {
                return new Promise(function(resolve, reject) {
                    var oldLink = document.querySelector("link[href*='" + fileName + "']");
                    var link = document.createElement('link');
                    var href = oldLink.href.replace(fileName, newFileName);

                    link.rel = 'stylesheet';
                    link.type = 'text/css';
                    link.href = href;
                    document.head.insertBefore(link, oldLink);

                    // Important success and error for the promise
                    link.onload = function() {
                        resolve(href);
                        oldLink.remove();
                    };

                    link.onerror = function() {
                        reject(href);
                    };
                });
            };

            // Set page loading state
            document.body.classList.add('page-loading');

            if (mode === 'dark') {
                Promise.all([
                    loadCssFile('plugins.bundle.rtl.css', 'plugins.dark.bundle.rtl.css'),
                    loadCssFile('style.bundle.rtl.css', 'style.dark.bundle.rtl.css'),
                    //loadCssFile('fullcalendar.bundle.rtl.css', 'fullcalendar.dark.bundle.rtl.css'),
                ]).then(function() {
                    // Set dark mode class
                    document.body.classList.add("dark-mode");
                    document.body.classList.add("header-background-dark");
                    document.body.classList.remove("header-background-light");
                    $('#kt_header').addClass('header-background-dark');
                    $('#kt_header').removeClass('header-background-light');
                    // Remove page loading srate
                    document.body.classList.remove('page-loading');

                    if (cb instanceof Function) {
                        cb();
                    }
                }).catch(function() {
                    // error
                });
            } else if (mode === 'light') {
                Promise.all([
                    loadCssFile('plugins.dark.bundle.rtl.css', 'plugins.bundle.rtl.css'),
                    loadCssFile('style.dark.bundle.rtl.css', 'style.bundle.rtl.css'),
                    //loadCssFile('fullcalendar.dark.bundle.rtl.css', 'fullcalendar.bundle.rtl.css'),
                ]).then(function() {
                    // Remove dark mode class
                    document.body.classList.remove("dark-mode");
                    document.body.classList.remove("header-background-dark");
                    document.body.classList.add("header-background-light");
                    $('#kt_header').addClass('header-background-light');
                    $('#kt_header').removeClass('header-background-dark');
                    // Remove page loading srate
                    document.body.classList.remove('page-loading');

                    // Callback
                    if (cb instanceof Function) {
                        cb();
                    }
                }).catch(function() {
                    // error
                });
            }
        }

        $mode = localStorage.getItem('theme');
        if ($mode == 'dark') {
            $('#darkMode').prop('checked', true);
        }

        $('#darkMode').on('change', function() {
            if ($(this).is(':checked')) {
                setThemeMode('dark');
            } else {
                setThemeMode('light');
            }
        });
/*         var customScroll = new slimScroll();
        window.onresize = customScroll.resetValues; */
    </script>
    @stack('scripts')
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
