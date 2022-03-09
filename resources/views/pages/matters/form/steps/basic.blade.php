<!--begin::Wrapper-->
<div class="w-100">
    <!--begin::Heading-->
    <div class="">
        <!--begin::Title-->
        <h2 class="fw-bolder d-flex align-items-center text-dark">{{ __('app.basic_data') }}
            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                title="Billing is issued based on your selected account type"></i>
        </h2>
        <!--end::Title-->
        <!--begin::Notice-->
        <div class="text-muted fw-bold fs-6">If you need more info, please check out
            <a href="#" class="link-primary fw-bolder">Help Page</a>.
        </div>
        <!--end::Notice-->
    </div>
    <!--end::Heading-->
    <div class="separator separator-dashed my-10"></div>
    <!--begin::Input group-->
    <!--begin::Row-->
    <div class="row gx-10 mb-5">
        <!--begin::Col-->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <div class="fv-row mb-5">
                        <label
                            class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.matter.receive-date') }}</label>
                        <input type="text" name="receive_date" data-control="flatpickr"
                            class="form-control form-control-solid" placeholder="Matter Receive Date">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="fv-row mb-5">
                        <label
                            class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.matter.number') }}</label>
                        <input type="text" name="number" class="form-control form-control-solid"
                            placeholder="Matter Number">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="fv-row -ml-1mb-5">
                        <label
                            class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.matter.year') }}</label>
                        <input type="text" name="year" class="form-control form-control-solid"
                            placeholder="Matter Year">
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="separator separator-dashed my-10"></div>
    <div class="fv-row">
        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.matter.commissioning') }}</label>
        <!--begin::Row-->
        <div class="row">
            <!--begin::Col-->
            <div class="col-lg-6">
                <!--begin::Option-->
                <input type="radio" class="btn-check matter-commissioning" name="commissioning" value="individual"
                    checked="checked" id="kt_commissioning_individual" />
                <label
                    class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-10"
                    for="kt_commissioning_individual">
                    <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                    <span class="svg-icon svg-icon-3x me-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                fill="black" />
                            <path opacity="0.3"
                                d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--begin::Info-->
                    <span class="d-block fw-bold text-start">
                        <span class="text-dark fw-bolder d-block fs-4 mb-2">{{ __('app.individual') }}</span>
                        <span class="text-muted fw-bold fs-6">If you need more info, please
                            check it
                            out</span>
                    </span>
                    <!--end::Info-->
                </label>
                <!--end::Option-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-lg-6">
                <!--begin::Option-->
                <input type="radio" class="btn-check matter-commissioning" name="commissioning" value="committee"
                    id="kt_commissioning_committee" />
                <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center"
                    for="kt_commissioning_committee">
                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                    <span class="svg-icon svg-icon-3x me-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3"
                                d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                fill="black" />
                            <path
                                d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--begin::Info-->
                    <span class="d-block fw-bold text-start">
                        <span class="text-dark fw-bolder d-block fs-4 mb-2">{{ __('app.committee') }}</span>
                        <span class="text-muted fw-bold fs-6">Create corporate account to mane
                            users</span>
                    </span>
                    <!--end::Info-->
                </label>
                <!--end::Option-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Input group-->
    <div class="separator separator-dashed my-10"></div>
    <div class="row mb-5">
        <div class="col-lg-4">
            <div class="fv-row">
                <label class="form-label fw-bolder fs-6 text-gray-700">{{ __('app.court') }}</label>
                <!--end::Label-->
                <!--begin::Select-->
                <select name="court_id" aria-label="Select a court" data-control="select2"
                    data-placeholder="Select court" class="form-select form-select-solid">
                    <option value=""></option>
                    @foreach ($courts as $court)
                        <option value="{{$court['id']}}">{{$court['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="fv-row">
                <label class="form-label fw-bolder fs-6 text-gray-700">{{ __('app.level') }}</label>
                <!--end::Label-->
                <!--begin::Select-->
                <select name="level_id" aria-label="Select a Matter Level" data-control="select2"
                    data-placeholder="Select Level" class="form-select form-select-solid">
                    <option value=""></option>
                    
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="fv-row">
                <label class="form-label fw-bolder fs-6 text-gray-700">{{ __('app.type') }}</label>
                <!--end::Label-->
                <!--begin::Select-->
                <select name="type_id" aria-label="Select a Matter Type" data-control="select2"
                    data-placeholder="Select Type" class="form-select form-select-solid">
                    <option value=""></option>
                    @foreach ($types as $type)
                        <option value="{{$type['id']}}">{{$type['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="fv-row mb-5">
                <label
                    class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.matter.next-session-date') }}</label>
                <input type="text" name="next_session_date" data-control="flatpickr"
                    class="form-control form-control-solid" placeholder="Matter Next Session">
            </div>
        </div>
    </div>
</div>
<!--end::Wrapper-->
