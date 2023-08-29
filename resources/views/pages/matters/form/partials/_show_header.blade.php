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
                                        class="text-muted">{{ __('app.matter-no') }}:</span>
                                    {{ $matter->number }}, <span
                                        class="text-muted">{{ __('app.for-year') }}:</span>
                                    {{ $matter->year }}.</a>
                                <span
                                    class="fs-6 badge badge-light-{{ config('system.matter.status.' . $matter->status . '.color') }} me-auto">{{ __('app.' . $matter->status) }}</span>
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

                            <div class="d-flex align-self-center">
                                @if ($source == 'edit')
                                    @can('matter-delete')
                                        <form id="delete" action="{{ route('matter.destroy', $matter) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-icon btn-danger btn-active-danger me-2"
                                                type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="{{ __('app.delete') }}">
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                            fill="black" />
                                                        <path opacity="0.5"
                                                            d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                            fill="black" />
                                                        <path opacity="0.5"
                                                            d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </form>
                                        @push('scripts')
                                            <script>
                                                $('#delete').on('submit', function(e) {
                                                    e.preventDefault();
                                                    Swal.fire({
                                                        text: "{{ __('app.are_you_sure_to_delete_record') }}",
                                                        icon: "error",
                                                        buttonsStyling: false,
                                                        showCancelButton: true,
                                                        confirmButtonText: "{{ __('app.ok') }}",
                                                        cancelButtonText: "{{ __('app.cancel') }}",
                                                        customClass: {
                                                            confirmButton: "btn btn-danger",
                                                            cancelButton: 'btn btn-light',
                                                        }
                                                    }).then(function(result) {
                                                        if (result.isConfirmed) {
                                                            e.target.submit();
                                                        }
                                                    });
                                                });
                                            </script>
                                        @endpush
                                    @endcan
                                    @can('matter-create')
                                        <a href="#" class="btn btn-sm btn-icon btn-primary btn-active-primary me-2"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                            data-bs-original-title="{{ __('app.copy') }}">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen028.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="7" y="2" width="14" height="16" rx="3"
                                                        fill="currentColor"></rect>
                                                    <rect x="3" y="6" width="14" height="16" rx="3" fill="currentColor">
                                                    </rect>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                    @endcan
                                @endif
                                @if ($source == 'show' && ! $matter->isSubmitted())
                                    @can('matter-edit')
                                        <a href="{{ route('matter.edit', $matter) }}"
                                            class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary btn-sm me-2">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr076.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                                {{ __('app.edit') }}
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                    @endcan
                                @endif
                                <a href="{{ route('matter.index') }}"
                                    class="btn btn-sm btn-icon btn-primary btn-active-primary me-2"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('app.back') }}">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr076.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" width="12" height="2" rx="1"
                                                transform="matrix(-1 0 0 1 15.5 11)" fill="currentColor"></rect>
                                            <path
                                                d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z"
                                                fill="currentColor"></path>
                                            <path
                                                d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z"
                                                fill="#C4C4C4"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                            </div>
                            @can('matter-change-status')
                                @include('pages.matters.form.partials._change_status_form')
                            @endcan
                            {{-- <a href="#" class="btn btn-sm btn-success me-3">{{ __('app.collect-claim') }}</a> --}}
                            <!--begin::Menu-->
                            @if ($source != 'show')
                                <div class="me-0">
                                    <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                        <i class="bi bi-three-dots fs-3"></i>
                                    </button>
                                    <!--begin::Menu 3-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3"
                                        data-kt-menu="true">
                                        <!--begin::Heading-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                                {{ __('app.update_matter_data') }}</div>
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                data-bs-target="#addNextSessionDateModal">{{ __('app.add_next_session_date') }}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                data-bs-target="#changeDatesModal">{{ __('app.change_date') }}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link flex-stack px-3" data-bs-toggle="modal"
                                                data-bs-target="#addClaimModal">{{ __('app.add_claim') }}
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        {{-- <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                            data-bs-target="#addActivityModal">{{ __('app.add_activity') }}</a>
                                    </div> --}}
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3 my-1">
                                            <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                data-bs-target="#addAssistantModal">{{ __('app.assign_assistant') }}</a>
                                        </div>
                                        @if ($matter->commissioning == Matter::COMMITTEE)
                                            <div class="menu-item px-3 my-1">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#addExternlExpertModal">{{ __('app.add_external_expert') }}</a>
                                            </div>
                                        @endif

                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3 my-1">
                                            <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                data-bs-target="#addPartyModal">{{ __('app.add_party') }}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3 my-1">
                                            <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                data-bs-target="#addAdvocateModal">{{ __('app.add_advocate') }}</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu 3-->
                                </div>
                            @endif
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
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <div class="fs-4 fw-bolder">
                                        {{ $matter->received_date->format('d, M Y') }}
                                    </div>
                                </div>
                                <!--end::Number-->
                                <!--begin::Label-->
                                <div class="fw-bold fs-6 text-gray-400">{{ __('app.received-date') }}</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->
                            <!--begin::Stat-->
                            @if ($matter->next_session_date)
                                <div
                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bolder">
                                            {{ $matter->next_session_date->format('d, M Y') ?: null }}</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">{{ __('app.next-session-date') }}
                                    </div>
                                    <!--end::Label-->
                                </div>
                            @endif
                            <!--end::Stat-->
                            @if ($matter->isReported())
                                <div
                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bolder">
                                            {{ $matter->reported_date->format('d, M Y') }}
                                        </div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">{{ __('app.reported-date') }}</div>
                                    <!--end::Label-->
                                </div>
                            @endif
                            @if ($matter->isSubmitted())
                                <div
                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bolder">
                                            {{ $matter->submitted_date->format('d, M Y') }}
                                        </div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">{{ __('app.submitted-date') }}</div>
                                    <!--end::Label-->
                                </div>
                            @endif
                            @if ($matter->last_action_date)
                                <div
                                    class="border text-white bg-warning border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bolder">
                                            {{ $matter->last_action_date->format('d, M Y') }}
                                        </div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-white">{{ __('app.last_action_date') }}</div>
                                    <!--end::Label-->
                                </div>
                            @endif
                            <!--begin::Stat-->
                            <div class="border text-white bg-{{ $matter->claim_status_color }} border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3"
                                data-bs-toggle="tooltip" title="{{ __('app.' . $matter->claim_status) }}">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <div class="fs-4 fw-bolder" data-kt-countup="true"
                                        data-kt-countup-value="{{ $matter->claims_sum_amount }}"
                                        data-kt-countup-prefix="AED ">0</div>
                                </div>
                                <!--end::Number-->
                                <!--begin::Label-->
                                <div class="fw-bold fs-6">{{ __('app.claims') }}</div>
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
@if ($source != 'show')
    @include('pages.procedures.add-next-session-date-modal')
    @include('pages.procedures.change-dates-modal')
    @include('pages.claims.add-claim-modal')
    @include('pages.experts.add-assistant-modal')
    @include('pages.experts.add-external-expert-modal')
    @include('pages.parties.add-party-modal')
    @include('pages.parties.add-advocate-modal')
    @push('scripts')
        <script>
            $('[data-control="flatpickr"]').flatpickr({
                altInput: !0,
                altFormat: "d F, Y",
                dateFormat: "Y-m-d"
            });
        </script>
    @endpush
@endif
