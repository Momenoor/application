@include('laravel-menu::metronic-navbar')
{{-- @php
$menu = config('menu.main');
@endphp
<div class="menu menu-rounded menu-column menu-title-gray-700 menu-icon-gray-400 menu-arrow-gray-400 menu-bullet-gray-400 menu-arrow-gray-400 menu-state-bg fw-bold"
    data-kt-menu="true">
    <!--begin::Menu item-->
    @foreach ($menu as $item)
        @if (key_exists('permission', $item) &&
        Auth()->user()->canAny(data_get($item, 'permission')) or !key_exists('permission', $item))
            <div class="menu-item menu-accordion" {{ !data_get($item, 'submenu') ?: 'data-kt-menu-trigger="click"' }}>
                <!--begin::Menu link-->
                <a href="{{ data_get($item, 'link') ? route($item['link']) : '#' }}"
                    data-route="{{ $item['link'] ?? '#' }}" class="menu-link py-3 {{ $item['class'] ?? '' }}">
                    <span class="menu-icon">
                        <i class="bi bi-bar-chart fs-3"></i>
                    </span>
                    <span class="menu-title">{{ __('app.' . $item['title']) }}</span>
                    @if (key_exists('submenu', $item))
                        <span class="menu-arrow"></span>
                    @endif
                </a>
                <!--end::Menu link-->
                @if (key_exists('submenu', $item))
                    <!--begin::Menu sub-->
                    <div class="menu-sub menu-sub-accordion pt-3">
                        <!--begin::Menu item-->
                        @foreach ($item['submenu'] as $subItem)
                            <div class="menu-item">
                                <a href="{{ data_get($subItem, 'link') ? route($subItem['link']) : '#' }}"
                                    data-route="{{ $subItem['link'] ?? '#' }}"
                                    class="menu-link py-3 {{ $subItem['class'] ?? '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('app.' . $subItem['title']) }}</span>
                                </a>
                            </div>
                        @endforeach
                        <!--end::Menu item-->
                    </div>
                @endif
                <!--end::Menu sub-->
            </div>
            <!--end::Menu item-->
        @endif
    @endforeach
</div>
@push('scripts')
    <script>
        $('.menu-link').each(function() {
            if ($(this).data('route') == '{{ Route::currentRouteName() }}') {
                $(this).addClass('active');
                $(this).parents('.menu-accordion').addClass('hover').addClass('show');
            }
        })
    </script>
@endpush --}}
