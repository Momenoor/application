<div class="card">
    <div class="card-header">
        <div class="card-title">
            <div class="card-label fw-bolder fs-3 mb-1">
                {{__('app.create-new-matter')}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row gx-10 mb-5 w-900px">
            <div class="col-lg-3">
                <h4 class="fw-bolder d-flex align-items-center text-dark">{{ __('app.basic-data') }}
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                       title="Billing is issued based on your selected account type"></i>
                </h4>
            </div>
            <!--begin::Col-->
            <div class="col-lg-9">
                <!--end::Title-->
                <!--begin::Notice-->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="fv-row mb-5">
                            <label for="receive_date"
                                   class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.receive-date') }}</label>
                            <input id="receive_date" type="text" name="matter[received_date]"
                                   data-control="flatpickr"
                                   value="{{old('matter.receive_date')}}"
                                   class="@error('matter.received_date') is-invalid @enderror form-control form-control-solid"
                                   placeholder="{{__('app.received_date')}}">
                            @error('matter.received_date')
                            <div class="invalid-feedback fv-plugins-message-container">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="fv-row -ml-1mb-5">
                            <label for="year"
                                   class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.year') }}</label>
                            <input type="text" name="matter[year]" id="year" wire:model="matter.year"
                                   class="@error('matter.year') is-invalid @enderror form-control form-control-solid"
                                   placeholder="{{__('app.year')}}">
                            @error('matter.year')
                            <div class="invalid-feedback fv-plugins-message-container">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="fv-row mb-5">
                            <label for="number"
                                   class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.number') }}</label>
                            <input type="text" name="matter[number]" id="number" wire:model="matter.number"
                                   class="@error('matter.number') is-invalid @enderror form-control form-control-solid"
                                   placeholder="{{__('app.number')}}">
                            @error('matter.number')
                            <div class="invalid-feedback fv-plugins-message-container">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="separator separator-dashed my-10"></div>
                <!--end::Col-->
            </div>
            <div class="col-lg-9 offset-lg-3">
                <!--begin::Row-->
                <div class="row">
                    <label
                        class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.commissioning') }}</label>
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        <!--begin::Option-->
                        <input type="radio"
                               class="@error('matter.commissioning') is-invalid @enderror btn-check matter-commissioning"
                               name="matter[commissioning]" @selected(old('matter.commissioning') == 'individual')
                               value="individual" id="kt_commissioning_individual"/>
                        <label
                            class="@error('matter.commissioning') is-invalid @enderror btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-10"
                            for="kt_commissioning_individual">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                            <span class="svg-icon svg-icon-3x me-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
                                    <path
                                        d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                        fill="black"/>
                                    <path opacity="0.3"
                                          d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                          fill="black"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--begin::Info-->
                            <span class="d-block fw-bold text-start">
                                <span
                                    class="text-dark fw-bolder d-block fs-4 mb-8 mt-7">{{ __('app.individual') }}</span>
                                <span class="text-muted fw-bold fs-6"></span>
                            </span>
                            <!--end::Info-->
                        </label>
                        <!--end::Option-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-lg-6">
                        <!--begin::Option-->
                        <input type="radio"
                               class="btn-check matter-commissioning @error('matter.commissioning') is-invalid @enderror "
                               name="matter[commissioning]" @selected(old('matter.commissioning') == 'committee')
                               value="committee" id="kt_commissioning_committee"/>
                        <label
                            class="@error('matter.commissioning') is-invalid @enderror btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center"
                            for="kt_commissioning_committee">
                            <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                            <span class="svg-icon svg-icon-3x me-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
                                    <path opacity="0.3"
                                          d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                          fill="black"/>
                                    <path
                                        d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                        fill="black"/>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--begin::Info-->
                            <span class="d-block fw-bold text-start">
                                <span class="text-dark fw-bolder d-block fs-4 mb-2">{{ __('app.committee') }}</span>
                                <span class="text-muted fw-bold fs-9">{{__('app.That\'s mean, you should add committee
                                    member
                                    below.')}}</span>
                            </span>
                            <!--end::Info-->
                        </label>
                        <!--end::Option-->
                    </div>
                    <!--end::Col-->
                    @error('matter.commissioning')
                    <div class="invalid-feedback fv-plugins-message-container">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <!--end::Row-->
            </div>
            <div class="col-lg-9 offset-lg-3">
                <div class="separator separator-dashed my-5"></div>
                <div class="row pt-5">
                    <div class="col-lg-4">
                        <label class="form-label fw-bolder fs-6 text-gray-700">{{ __('app.court') }}</label>
                        <!--end::Label-->
                        <!--begin::Select-->
                        <select name="matter[court_id]" aria-label="Select a court" data-control="select2"
                                data-placeholder="{{__('app.select_a_court')}}"
                                class="@error('matter.court_id') is-invalid @enderror form-select form-select-solid">
                            <option value=""></option>
                            @foreach ($courts as $court)
                                <option
                                    @selected(old('matter.court_id') == $court->id) value="{{ $court->id }}"> {{ $court->name }}</option>
                            @endforeach
                        </select>
                        @error('matter.court_id')
                        <div class="invalid-feedback fv-plugins-message-container">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label fw-bolder fs-6 text-gray-700">{{ __('app.level') }}</label>
                        <select name="matter[level_id]" aria-label="{{__('app.select_a_level')}}"
                                data-control="select2"
                                data-placeholder="{{__('app.select_a_level')}}"
                                class="@error('matter.level_id') is-invalid @enderror form-select form-select-solid">
                            <option value=""></option>
                            @foreach ($levels as $level)
                                <option
                                    @selected(old('matter.level_id') == $level->id) value="{{ $level->id }}">{{ __('app.'.$level->name) }}</option>
                            @endforeach
                        </select>
                        @error('matter.level_id')
                        <div class="invalid-feedback fv-plugins-message-container">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label fw-bolder fs-6 text-gray-700">{{ __('app.type') }}</label>
                        <select name="matter[type_id]" aria-label="{{__('app.select_a_type')}}"
                                data-control="select2"
                                data-placeholder="{{__('app.select_a_type')}}"
                                class="@error('matter.type_id') is-invalid @enderror form-select form-select-solid">
                            <option value=""></option>
                            @foreach ($types as $type)
                                <option
                                    @selected(old('matter.type_id') == $type->id) value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('matter.type_id')
                        <div class="invalid-feedback fv-plugins-message-container">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 mt-10">
                        <label for="next_session_date"
                               class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.next-session-date') }}</label>
                        <input id="next_session_date" type="text" name="matter[next_session_date]"
                               data-control="flatpickr" value="{{old('matter.next_session_date')}}"
                               class="@error('matter.next_session_date') is-invalid @enderror form-control form-control-solid"
                               placeholder="{{__('app.next_session_date')}}">
                        @error('matter.next_session_date')
                        <div class="invalid-feedback fv-plugins-message-container">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
