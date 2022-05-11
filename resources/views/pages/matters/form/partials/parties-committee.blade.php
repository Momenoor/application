@if (isset($matter['commissioning']) && $matter['commissioning'] == $committeeChoiceValue)
    <div class="col-lg-12 mb-10">
        <label class="form-label fw-bolder fs-6 text-gray-700 w-100">{{ __('app.experts') }}
            <a href="javascript:;" class="fw-light text-active-dark float-end" data-bs-toggle="modal"
                data-bs-target="#addExpertLivewireModal">إضافة جديد</a></label>
        <!--end::Label-->
        <!--begin::Select-->
        <select data-dir="rtl" name="committee" aria-label="Select a Matter Committee Expert " data-control="select2"
            data-placeholder="{{ __('app.select_expert') }}" wire:model="experts.committee" multiple
            class="form-select form-select-solid @error('experts.committee') is-invalid @enderror ">
            <option value=""></option>
            @foreach ($committeesList as $committee)
                <option value="{{ $committee['id'] }}">{{ $committee['id'] }} -
                    {{ $committee['name'] }}
                </option>
            @endforeach
        </select>
        @error('experts.committee')
            <div class="invalid-feedback fv-plugins-message-container">
                {{ $message }}
            </div>
        @enderror
    </div>
@endif
@include('pages.experts.add-expert-form-modal')
