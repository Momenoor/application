@if (isset($matter['commissioning']) && $matter['commissioning'] == $committeeChoiceValue)
    <div class="col-lg-12 mb-10">
        <label class="form-label fw-bolder fs-6 text-gray-700">{{ __('app.expert') }}</label>
        <!--end::Label-->
        <!--begin::Select-->
        <select name="committee" aria-label="Select a Matter Committee Expert @error('matter.committee') is-invalid @enderror " data-control="select2"
            data-placeholder="Select Expert" wire:model="matter.committee" multiple
            class="form-select form-select-solid">
            <option value=""></option>
            @foreach ($committeesList as $committee)
                <option value="{{ $committee['id'] }}">{{ $committee['id'] }} -
                    {{ $committee['name'] }}
                </option>
            @endforeach
        </select>
        @error('matter.committee')
        <div class="invalid-feedback fv-plugins-message-container">
            {{ $message }}
        </div>
    @enderror
    </div>
@endif
