<div class="menu menu-rounded menu-column menu-title-gray-700 menu-icon-gray-400 menu-arrow-gray-400 menu-bullet-gray-400 menu-arrow-gray-400 menu-state-bg fw-bold"
    data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
        <!--begin::Menu link-->
        <a href="#" class="menu-link py-3">
            <span class="menu-icon">
                <i class="bi bi-bar-chart fs-3"></i>
            </span>
            <span class="menu-title">{{__('app.matters')}}</span>
            <span class="menu-arrow"></span>
        </a>
        <!--end::Menu link-->

        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-accordion pt-3">
            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{route('matter.index')}}" class="menu-link py-3">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{__('app.matters_list')}}</span>
                </a>
            </div>
            <!--end::Menu item-->

            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{route('matter.create')}}" class="menu-link py-3">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{__('app.create_matter')}}</span>
                </a>
            </div>
            <!--end::Menu item-->
        </div>
        <!--end::Menu sub-->
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item menu-accordion" data-kt-menu-trigger="click">
        <!--begin::Menu link-->
        <a href="#" class="menu-link py-3">
            <span class="menu-icon">
                <i class="bi bi-bar-chart fs-3"></i>
            </span>
            <span class="menu-title">{{__('app.users')}}</span>
            <span class="menu-arrow"></span>
        </a>
        <!--end::Menu link-->

        <!--begin::Menu sub-->
        <div class="menu-sub menu-sub-accordion pt-3">
            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{route('user.index')}}" class="menu-link py-3">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{__('app.users_list')}}</span>
                </a>
            </div>
            <!--end::Menu item-->

            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{route('user.create')}}" class="menu-link py-3">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{__('app.create_user')}}</span>
                </a>
            </div>
            <!--end::Menu item-->

            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{route('role.index')}}" class="menu-link py-3">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{__('app.user_roles')}}</span>
                </a>
            </div>
            <!--end::Menu item-->

            <!--begin::Menu item-->
            <div class="menu-item">
                <a href="{{route('permission.index')}}" class="menu-link py-3">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{__('app.user_permissions')}}</span>
                </a>
            </div>
            <!--end::Menu item-->
        </div>
        <!--end::Menu sub-->
    </div>
    <!--end::Menu item-->
</div>
