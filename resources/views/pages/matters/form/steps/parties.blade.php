<!--begin::Wrapper-->
<div class="w-100">
    <!--begin::Heading-->
    <div class="">
        <!--begin::Title-->
        <h2 class="fw-bolder text-dark">{{ __('app.parties') }}</h2>
        <!--end::Title-->
        <!--begin::Notice-->
        <div class="text-muted fw-bold fs-6">If you need more info, please check out
            <a href="#" class="link-primary fw-bolder">Help Page</a>.
        </div>
        <!--end::Notice-->
    </div>
    <div class="separator separator-dashed my-10"></div>
    <!--end::Heading-->
    <!--begin::Input group-->
    <!--begin::Repeater-->


    <div class="mb-10">
        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Experts:</label>
        <div class="row">
            <div class="col-lg-12">
                <div class="fv-row mb-5">
                    <label class="form-label fs-6 text-gray-700">{{ __('app.expert') }}</label>
                    <!--end::Label-->
                    <!--begin::Select-->
                    <select name="expert_id" aria-label="Select a Expert" data-control="select2"
                        data-placeholder="Select Expert" class="form-select form-select-solid">
                        <option value=""></option>

                        @foreach ($experts as $expert)
                            <option {{ old('expert_id') == $expert['id'] ? 'selected' : '' }}
                                value="{{ $expert['id'] }}">
                                <b>{{ $expert['id'] }}</b> - {{ $expert['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="d-none committee-input">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="fv-row mb-5">
                        <label
                            class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.matter.experts-committee') }}</label>
                        <select name="parties[committee][name][]" aria-label="Select a Expert"
                            data-placeholder="Select Expert" class="form-select form-select-solid mb-5 mb-md-0" multiple
                            data-control="select2" disabled>
                            @foreach ($committees as $committee)
                                <option
                                    {{ is_array(old('parties.committee.name')) && in_array($committee['id'], old('parties.committee.name'))? 'selected': '' }}
                                    value="{{ $committee['id'] }}">{{ $committee['name'] }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="parties[committee][type]" value="committee" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="separator separator-dashed my-10"></div>
    <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">Parties:</label>
    @livewire('matter-create-party',key('parties-'.time()))
    <!--end::Repeater-->
    <!--end::Input group-->
</div>
<!--end::Wrapper-->
<!--end::Form group-->
