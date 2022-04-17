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
                            @livewire('matter-change-status', ['matter' => $matter])
                            {{-- <a href="#" class="btn btn-sm btn-success me-3">{{ __('app.collect-claim') }}</a> --}}
                            <!--begin::Menu-->
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
                                        <a href="#" class="menu-link flex-stack px-3" data-bs-toggle="modal"
                                            data-bs-target="#addClaimModal">{{ __('app.add_claim') }}
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                            data-bs-target="#addActivityModal">{{ __('app.add_activity') }}</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-1">
                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                            data-bs-target="#addPartyModal">{{ __('app.add_party') }}</a>
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
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
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
<div class="modal fade" tabindex="-1" id="addNextSessionDateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('procedure.next-session', $matter) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.add_next_session_date') }}</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="row mb-10">
                        <div class="col-12">
                            <label class="required form-label">{{ __('app.next-session-date') }}</label>
                            <!--end::Label-->
                            <input type="text" name="datetime" data-control="flatpickr"
                                class="form-control  form-control-solid"
                                placeholder="{{ __('app.next-session-date') }}">
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-12">
                            <label class="required form-label">البيان</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="description" class="form-control  form-control-solid"
                                placeholder="{{ __('app.description') }}"></textarea>
                            <!--end::Input-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light"
                        data-bs-dismiss="modal">{{ __('app.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('app.add') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('[data-control="flatpickr"]').flatpickr({
            altInput: !0,
            altFormat: "d F, Y",
            dateFormat: "Y-m-d"
        });
    </script>
@endpush
