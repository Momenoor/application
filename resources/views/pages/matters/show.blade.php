@extends('layouts.app')
@section('content')
    <div class="">
        <div class="card mb-5 mb-xl-10">
            <div class="card-body">
                <div class="content flex-column-fluid">
                    <!--begin::Navbar-->
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                        <!--begin::Image-->
                        <div
                            class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7">
                            <i
                                class="fas fa-gavel fs-5tx text-{{ config('system.matter.status.' . $matter->status . '.color') }}"></i>
                        </div>
                        <!--end::Image-->
                        <!--begin::Wrapper-->
                        <div class="flex-grow-1">
                            <!--begin::Head-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::Details-->
                                <div class="d-flex flex-column">
                                    <!--begin::Status-->
                                    <div class="d-flex align-items-center mb-1">
                                        <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3"><span
                                                class="text-muted">{{ __('matter-no') }}:</span>
                                            {{ $matter->number }}, <span
                                                class="text-muted">{{ __('for-year') }}:</span>
                                            {{ $matter->year }}.</a>
                                        <span
                                            class="fs-6 badge badge-light-{{ config('system.matter.status.' . $matter->status . '.color') }} me-auto">{{ __($matter->status) }}</span>
                                    </div>
                                    <!--end::Status-->
                                    <!--begin::Description-->
                                    {{-- <div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400">#1 Tool to get started
                                            with Web Apps any Kind &amp; size</div> --}}
                                    <!--end::Description-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Actions-->
                                <div class="d-flex mb-4">
                                    @if ($matter->reported_date)
                                        {{$matter->reported_date}}
                                    @endif
                                    <a href="{{route('matter.change-status')}}"
                                        class="btn btn-sm btn-bg-light btn-active-color-primary me-3">{{ _('app.change-statue') }}</a>
                                    <a href="#" class="btn btn-sm btn-success me-3">{{ _('app.collect-claim') }}</a>
                                    <!--begin::Menu-->
                                    <div class="me-0">
                                        <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="bi bi-three-dots fs-3"></i>
                                        </button>
                                        <!--begin::Menu 3-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3"
                                            data-kt-menu="true">
                                            <!--begin::Heading-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                                    Payments</div>
                                            </div>
                                            <!--end::Heading-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Create Invoice</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link flex-stack px-3">Create Payment
                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                        title="Specify a target name for future usage and reference"></i></a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Generate Bill</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                data-kt-menu-placement="right-end">
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">Subscription</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <!--begin::Menu sub-->
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Plans</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Billing</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Statements</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu separator-->
                                                    <div class="separator my-2"></div>
                                                    <!--end::Menu separator-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3">
                                                            <!--begin::Switch-->
                                                            <label
                                                                class="form-check form-switch form-check-custom form-check-solid">
                                                                <!--begin::Input-->
                                                                <input class="form-check-input w-30px h-20px"
                                                                    type="checkbox" value="1" checked="checked"
                                                                    name="notifications" />
                                                                <!--end::Input-->
                                                                <!--end::Label-->
                                                                <span
                                                                    class="form-check-label text-muted fs-6">Recuring</span>
                                                                <!--end::Label-->
                                                            </label>
                                                            <!--end::Switch-->
                                                        </div>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu sub-->
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3 my-1">
                                                <a href="#" class="menu-link px-3">Settings</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu 3-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Head-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap justify-content-start">
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap">
                                    <!--begin::Stat-->
                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <div class="fs-4 fw-bolder">
                                                {{ $matter->received_date->format('d, M Y') }}
                                            </div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-6 text-gray-400">{{ __('received-date') }}</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    <!--begin::Stat-->
                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <div class="fs-4 fw-bolder">
                                                {{ $matter->next_session_date->format('d, M Y') }}</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-6 text-gray-400">{{ __('next-session-date') }}
                                        </div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    <!--begin::Stat-->
                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <div class="fs-4 fw-bolder" data-kt-countup="true"
                                                data-kt-countup-value="{{ $matter->claims_sum_amount }}"
                                                data-kt-countup-prefix="AED ">0</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-6 text-gray-400">{{ __('claims') }}</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Details-->
                </div>
            </div>
        </div>
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0 cursor-pointer">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bolder m-0">{{ __('app.matter-data') }}</h3>
                </div>
                <a href="{{ route('matter.edit', $matter) }}"
                    class="btn btn-primary align-self-center">{{ 'app.edit' }}</a>

                <!--end::Card title-->
            </div>
            <div class="card-body pt-0">
                <div class="separator"></div>
                <div class="row mt-10">
                    <div class="col-6">
                        <div class="row mb-10">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">{{ __('app.court') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{ $matter->court->name }}</span>
                                @include('common.external-link', [
                                    'href' => route('court.show', $matter->court),
                                ])
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-10">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">{{ __('app.type') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{ $matter->type->name }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row mb-10">
                            <label class="col-4 fw-bold text-muted">{{ __('app.commissioning') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{ $matter->commissioning }}</span>
                            </div>
                        </div>
                        <div class="row mb-10">
                            <label class="col-4 fw-bold text-muted">{{ __('app.status') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-8">
                                <span
                                    class="fw-bolder fs-6 text-gray-800">{{ $matter->parent_id > 0 ? __('app.supplementary') : __('app.basic') }}</span>
                                @if ($matter->parent_id > 0)
                                    @include('common.external-link', [
                                        'href' => route('matter.show', $matter->parent_id),
                                    ])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 col-md-12 mb-5">
                <!--begin::Card-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header border-bottom">
                        <!--begin::Card title-->
                        <div class="card-title flex-column">
                            <h3 class="fw-bolder mb-1">{{ __('app.parites') }}</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card toolbar-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-column pt-3 mb-9">
                        <!--begin::Item-->
                        <div class="tree">
                            <li class="border-bottom-dashed  border-bottom border-gray-500 mb-5 pb-5">
                                <div class="d-flex align-items-center">
                                    <div class="me-5 position-relative">
                                        <div class="symbol symbol-35px symbol-circle">
                                            <span class="symbol-label bg-dark text-light fw-bolder">E1</span>
                                        </div>
                                    </div>
                                    <div class="fw-bold">
                                        <div class="fs-5 fw-bolder text-gray-900">
                                            {{ $matter->expert->name }}
                                        </div>
                                    </div>
                                    <div class="badge badge-dark ms-auto">
                                        {{ __('app.expert') }} {{ __('app.' . $matter->expert->field) }}</div>
                                </div>
                            </li>
                        </div>
                        @php
                            $n = 1;
                        @endphp
                        @foreach ($matter->experts as $expert)
                            <div class="tree">
                                <li class="border-bottom-dashed  border-bottom border-gray-500 mb-5 pb-5">
                                    <div class="d-flex align-items-center">
                                        <div class="me-5 position-relative">
                                            <div class="symbol symbol-35px symbol-circle">
                                                <span
                                                    class="symbol-label bg-light-light text-dark fw-bolder">A{{ $n }}</span>
                                            </div>
                                        </div>
                                        <div class="fw-bold">
                                            <div class="fs-5 fw-bolder text-gray-900">
                                                {{ $expert->name }}
                                            </div>
                                        </div>
                                        <div class="badge badge-light ms-auto">
                                            {{ __('app.' . $expert->pivot->type) }}</div>
                                    </div>
                                </li>
                            </div>
                            @php
                                $n++;
                            @endphp
                        @endforeach
                        @php
                            $n = 1;
                        @endphp
                        @foreach ($matter->marketers as $marketer)
                            <div class="tree">
                                <li class="border-bottom-dashed  border-bottom border-gray-500 mb-5 pb-5">
                                    <div class="d-flex align-items-center">
                                        <div class="me-5 position-relative">
                                            <div class="symbol symbol-35px symbol-circle">
                                                <span
                                                    class="symbol-label bg-light-light text-light fw-bolder">M{{ $n }}</span>
                                            </div>
                                        </div>
                                        <div class="fw-bold">
                                            <div class="fs-5 fw-bolder text-gray-900">
                                                {{ $marketer->name }}
                                            </div>
                                        </div>
                                        <div class="badge badge-light ms-auto">
                                            {{ __('app.' . $marketer->pivot->type) }}</div>
                                    </div>
                                </li>
                            </div>
                            @php
                                $n++;
                            @endphp
                        @endforeach
                        <div class="tree">
                            <div>
                                @php
                                    $n = 1;
                                @endphp
                                @foreach ($parties as $party)
                                    <li
                                        class="@if (!$loop->last) border-bottom-dashed  border-bottom border-gray-500 mb-5 pb-5 @endif ">
                                        <div class="d-flex align-items-center">
                                            <div class="me-5 position-relative">
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <span
                                                        class="symbol-label bg-light-{{ $party['color'] }} text-{{ $party['color'] }} fw-bolder">P{{ $n }}</span>
                                                </div>
                                            </div>
                                            <div class="fw-bold">
                                                <div
                                                    class="fs-5 fw-bolder text-gray-900 text-hover-{{ $party['color'] }}">
                                                    {{ $party['name'] }}
                                                </div>
                                            </div>
                                            <div class="badge badge-{{ $party['color'] }} ms-auto">
                                                {{ __('app.' . $party['pivot']['type']) }}</div>
                                        </div>
                                        @if (key_exists('subparty', $party))
                                            <ul class="mt-3">
                                                @foreach ($party['subparty'] as $subparty)
                                                    <li class="d-flex align-items-center">
                                                        <div
                                                            class="text-gray-700 ms-15 text-hover-{{ $party['color'] }}">
                                                            {{ $subparty->name }}</div>
                                                        <div class="badge badge-light ms-auto">
                                                            {{ __('app.' . $subparty->type) }}</div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                    @php
                                        $n++;
                                    @endphp
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-5 col-md-12">
                <!--begin::Card-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header mt-6">
                        <!--begin::Card title-->
                        <div class="card-title flex-column">
                            <h3 class="fw-bolder mb-1">{{ __('app.attachment') }}</h3>
                            <div class="fs-6 text-gray-400">
                                {{ __('app.total') . 'count' . __('app.files') . ',' . 'size' . __('app.space-used') }}
                            </div>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View All</a>
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body p-9 pt-3">
                        <!--begin::Files-->
                        <div class="d-flex flex-column mb-9">
                            <!--begin::File-->
                            <div class="d-flex align-items-center mb-5">
                                <!--begin::Icon-->
                                <div class="symbol symbol-30px me-5">
                                    <img alt="Icon" src="{{ asset('assets/media/svg/files/pdf.svg') }}" />
                                </div>
                                <!--end::Icon-->
                                <!--begin::Details-->
                                <div class="fw-bold">
                                    <a class="fs-6 fw-bolder text-dark text-hover-primary" href="#">Project tech
                                        requirements</a>
                                    <div class="text-gray-400">2 days ago
                                        <a href="#">Karina Clark</a>
                                    </div>
                                </div>
                                <!--end::Details-->
                                <!--begin::Menu-->
                                <button type="button"
                                    class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                                <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000"
                                                    opacity="0.3" />
                                                <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000"
                                                    opacity="0.3" />
                                                <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000"
                                                    opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                    id="kt_menu_623758445c953">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <select class="form-select form-select-solid" data-kt-select2="true"
                                                    data-placeholder="Select option"
                                                    data-dropdown-parent="#kt_menu_623758445c953" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Pending</option>
                                                    <option value="2">In Process</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Member Type:</label>
                                            <!--end::Label-->
                                            <!--begin::Options-->
                                            <div class="d-flex">
                                                <!--begin::Options-->
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <!--end::Options-->
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2"
                                                        checked="checked" />
                                                    <span class="form-check-label">Customer</span>
                                                </label>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Options-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Notifications:</label>
                                            <!--end::Label-->
                                            <!--begin::Switch-->
                                            <div
                                                class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="notifications" checked="checked" />
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                            <!--end::Switch-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                data-kt-menu-dismiss="true">Apply</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Menu-->
                            </div>
                            <!--end::File-->
                            <!--begin::File-->
                            <div class="d-flex align-items-center mb-5">
                                <!--begin::Icon-->
                                <div class="symbol symbol-30px me-5">
                                    <img alt="Icon" src="{{ asset('assets/media/svg/files/doc.svg') }}" />
                                </div>
                                <!--end::Icon-->
                                <!--begin::Details-->
                                <div class="fw-bold">
                                    <a class="fs-6 fw-bolder text-dark text-hover-primary" href="#">Create FureStibe
                                        branding proposal</a>
                                    <div class="text-gray-400">Due in 1 day
                                        <a href="#">Marcus Blake</a>
                                    </div>
                                </div>
                                <!--end::Details-->
                                <!--begin::Menu-->
                                <button type="button"
                                    class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                                <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000"
                                                    opacity="0.3" />
                                                <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000"
                                                    opacity="0.3" />
                                                <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000"
                                                    opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                    id="kt_menu_623758445c9e2">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <select class="form-select form-select-solid" data-kt-select2="true"
                                                    data-placeholder="Select option"
                                                    data-dropdown-parent="#kt_menu_623758445c9e2" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Pending</option>
                                                    <option value="2">In Process</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Member Type:</label>
                                            <!--end::Label-->
                                            <!--begin::Options-->
                                            <div class="d-flex">
                                                <!--begin::Options-->
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <!--end::Options-->
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2"
                                                        checked="checked" />
                                                    <span class="form-check-label">Customer</span>
                                                </label>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Options-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Notifications:</label>
                                            <!--end::Label-->
                                            <!--begin::Switch-->
                                            <div
                                                class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="notifications" checked="checked" />
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                            <!--end::Switch-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                data-kt-menu-dismiss="true">Apply</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Menu-->
                            </div>
                            <!--end::File-->
                            <!--begin::File-->
                            <div class="d-flex align-items-center mb-5">
                                <!--begin::Icon-->
                                <div class="symbol symbol-30px me-5">
                                    <img alt="Icon" src="{{ asset('assets/media/svg/files/css.svg') }}" />
                                </div>
                                <!--end::Icon-->
                                <!--begin::Details-->
                                <div class="fw-bold">
                                    <a class="fs-6 fw-bolder text-dark text-hover-primary" href="#">Completed Project
                                        Stylings</a>
                                    <div class="text-gray-400">Due in 1 day
                                        <a href="#">Terry Barry</a>
                                    </div>
                                </div>
                                <!--end::Details-->
                                <!--begin::Menu-->
                                <button type="button"
                                    class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                                <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000"
                                                    opacity="0.3" />
                                                <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000"
                                                    opacity="0.3" />
                                                <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000"
                                                    opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                    id="kt_menu_623758445ca74">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <select class="form-select form-select-solid" data-kt-select2="true"
                                                    data-placeholder="Select option"
                                                    data-dropdown-parent="#kt_menu_623758445ca74" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Pending</option>
                                                    <option value="2">In Process</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Member Type:</label>
                                            <!--end::Label-->
                                            <!--begin::Options-->
                                            <div class="d-flex">
                                                <!--begin::Options-->
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <!--end::Options-->
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2"
                                                        checked="checked" />
                                                    <span class="form-check-label">Customer</span>
                                                </label>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Options-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Notifications:</label>
                                            <!--end::Label-->
                                            <!--begin::Switch-->
                                            <div
                                                class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="notifications" checked="checked" />
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                            <!--end::Switch-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                data-kt-menu-dismiss="true">Apply</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Menu-->
                            </div>
                            <!--end::File-->
                            <!--begin::File-->
                            <div class="d-flex align-items-center">
                                <!--begin::Icon-->
                                <div class="symbol symbol-30px me-5">
                                    <img alt="Icon" src="{{ asset('assets/media/svg/files/ai.svg') }}" />
                                </div>
                                <!--end::Icon-->
                                <!--begin::Details-->
                                <div class="fw-bold">
                                    <a class="fs-6 fw-bolder text-dark text-hover-primary" href="#">Create Project
                                        Wireframes</a>
                                    <div class="text-gray-400">Due in 3 days
                                        <a href="#">Roth Bloom</a>
                                    </div>
                                </div>
                                <!--end::Details-->
                                <!--begin::Menu-->
                                <button type="button"
                                    class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                                <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000"
                                                    opacity="0.3" />
                                                <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000"
                                                    opacity="0.3" />
                                                <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000"
                                                    opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                    id="kt_menu_623758445cb0e">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <select class="form-select form-select-solid" data-kt-select2="true"
                                                    data-placeholder="Select option"
                                                    data-dropdown-parent="#kt_menu_623758445cb0e" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Pending</option>
                                                    <option value="2">In Process</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Member Type:</label>
                                            <!--end::Label-->
                                            <!--begin::Options-->
                                            <div class="d-flex">
                                                <!--begin::Options-->
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <!--end::Options-->
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2"
                                                        checked="checked" />
                                                    <span class="form-check-label">Customer</span>
                                                </label>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Options-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Notifications:</label>
                                            <!--end::Label-->
                                            <!--begin::Switch-->
                                            <div
                                                class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="notifications" checked="checked" />
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                            <!--end::Switch-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                data-kt-menu-dismiss="true">Apply</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Menu-->
                            </div>
                            <!--end::File-->
                        </div>
                        <!--end::Files-->
                        <!--begin::Notice-->
                        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: svg/files/upload.svg-->
                            <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="67" height="67" viewBox="0 0 67 67"
                                    fill="none">
                                    <path opacity="0.25"
                                        d="M8.375 11.167C8.375 6.54161 12.1246 2.79199 16.75 2.79199H43.9893C46.2105 2.79199 48.3407 3.67436 49.9113 5.24497L56.172 11.5057C57.7426 13.0763 58.625 15.2065 58.625 17.4277V55.8337C58.625 60.459 54.8754 64.2087 50.25 64.2087H16.75C12.1246 64.2087 8.375 60.459 8.375 55.8337V11.167Z"
                                        fill="#00A3FF" />
                                    <path
                                        d="M41.875 5.28162C41.875 3.90663 42.9896 2.79199 44.3646 2.79199V2.79199C46.3455 2.79199 48.2452 3.57889 49.6459 4.97957L56.4374 11.7711C57.8381 13.1718 58.625 15.0715 58.625 17.0524V17.0524C58.625 18.4274 57.5104 19.542 56.1354 19.542H44.6667C43.1249 19.542 41.875 18.2921 41.875 16.7503V5.28162Z"
                                        fill="#00A3FF" />
                                    <path
                                        d="M32.4311 25.3368C32.1018 25.4731 31.7933 25.675 31.5257 25.9427L23.1507 34.3177C22.0605 35.4079 22.0605 37.1755 23.1507 38.2657C24.2409 39.3559 26.0085 39.3559 27.0987 38.2657L30.708 34.6563V47.4583C30.708 49.0001 31.9579 50.25 33.4997 50.25C35.0415 50.25 36.2913 49.0001 36.2913 47.4583V34.6563L39.9007 38.2657C40.9909 39.3559 42.7585 39.3559 43.8487 38.2657C44.9389 37.1755 44.9389 35.4079 43.8487 34.3177L35.4737 25.9427C34.6511 25.1201 33.443 24.9182 32.4311 25.3368Z"
                                        fill="#00A3FF" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1">
                                <!--begin::Content-->
                                <div class="fw-bold">
                                    <h4 class="text-gray-900 fw-bolder">Quick file uploader</h4>
                                    <div class="fs-6 text-gray-700">Drag &amp; Drop or choose files from computer</div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Notice-->
                    </div>
                    <!--end::Card body -->
                </div>
                <!--end::Card-->
            </div>
        </div>
        <!--end::Col-->
        <!--end::Col-->

    </div>
    {{-- Inject Scripts --}}
@endsection
@push('style')
    <style>
        .tree,
        .tree ul {
            margin: 0;
            padding: 0;
            list-style: none
        }

        .tree ul {
            margin-left: 1em;
            position: relative
        }

        .tree ul ul {
            margin-left: .5em
        }

        .tree ul:before {
            content: "";
            display: block;
            width: 0;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            border-left: 1px solid
        }

        .tree li {
            margin: 0;
            padding: 0 1em;
            line-height: 2em;
            color: #369;
            font-weight: 700;
            position: relative
        }

        .tree ul li:before {
            content: "";
            display: block;
            width: 3.75rem;
            height: 0;
            border-top: 1px solid;
            margin-top: -1px;
            position: absolute;
            top: 1em;
            left: 0
        }

        .tree ul li:last-child:before {
            background: #fff;
            height: auto;
            top: 1em;
            bottom: 0
        }

        .indicator {
            margin-right: 5px;
        }

        .tree li a {
            text-decoration: none;
            color: #369;
        }

        .tree li button,
        .tree li button:active,
        .tree li button:focus {
            text-decoration: none;
            color: #369;
            border: none;
            background: transparent;
            margin: 0px 0px 0px 0px;
            padding: 0px 0px 0px 0px;
            outline: 0;
        }

    </style>
@endpush
