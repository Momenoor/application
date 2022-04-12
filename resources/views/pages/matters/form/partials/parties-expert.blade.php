<div class="col-lg-12 mb-10">
    <label class="form-label fw-bolder fs-6 text-gray-700">{{ __('app.expert') }}</label>
    <!--end::Label-->
    <!--begin::Select-->
    <select name="expert_id" aria-label="Select a expert" data-control="select2" data-placeholder="Select expert"
        wire:model="matter.expert_id"
        class=" @error('matter.expert_id') is-invalid @enderror form-select form-select-solid">
        <option value=""></option>
        @foreach ($expertsList as $expert)
            <option value="{{ $expert['id'] }}">
                {{ $expert['name'] }}</option>
        @endforeach
    </select>
    @error('matter.expert_id')
        <div class="invalid-feedback fv-plugins-message-container">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-lg-12 mb-10">
    <label class="form-label fw-bolder fs-6 text-gray-700">{{ __('app.assistant') }}</label>
    <!--end::Label-->
    <!--begin::Select-->
    <select name="assistant_id" aria-label="Select a assistant" data-control="select2" data-placeholder="Select assistant"
        wire:model="matter.assistant"
        class=" @error('matter.assistant_id') is-invalid @enderror form-select form-select-solid">
        <option value=""></option>
        @foreach ($assistantsList as $assistant)
            <option value="{{ $assistant['id'] }}">
                {{ $assistant['name'] }}</option>
        @endforeach
    </select>
    @error('matter.assistant_id')
        <div class="invalid-feedback fv-plugins-message-container">
            {{ $message }}
        </div>
    @enderror
</div>
