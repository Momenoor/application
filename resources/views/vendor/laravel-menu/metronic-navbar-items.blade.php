@foreach ($items as $item)
    <!--begin::Menu item-->
    <div @lm_attrs($item) class="menu-item @if ($item->hasChildren()) menu-accordion @endif @if($item->isActive) show @endif"
        @if ($item->hasChildren()) data-kt-menu-trigger="click" @endif @lm_endattrs>
        <!--begin::Menu link-->
        <a @lm_attrs($item->link) href="{!! $item->url() !!}" class="menu-link py-3 @if($item->isActive && ! $item->hasChildren()) active @endif" @lm_endattrs>
            @if ($item->icon)
                <span class="menu-icon">
                    <i class="{{ $item->icon }} fs-3"></i>
                </span>
            @endif
            <span class="menu-bullet">
                <span class="bullet bullet-dot"></span>
            </span>
            <span class="menu-title"> {!! $item->title !!}</span>
            @if ($item->hasChildren())
                <span class="menu-arrow"></span>
            @endif
        </a>
        <!--end::Menu link-->
        <!--begin::Menu sub-->
        @if ($item->hasChildren())
            <div class="menu-sub menu-sub-accordion pt-3">
                <!--begin::Menu item-->
                @include(config('laravel-menu.views.bootstrap-items'), ['items' => $item->children()])
                <!--end::Menu item-->
            </div>
        @endif
        <!--end::Menu sub-->
    </div>
    <!--end::Menu item-->
@endforeach
@if ($item->divider)
    <div {!! Lavary\Menu\Builder::attributes($item->divider) !!}></div>
@endif
