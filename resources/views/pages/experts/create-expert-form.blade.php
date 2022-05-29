@php
if (!isset($expert)) {
    $expert = [];
}
@endphp
<div class="row">
    <div class="col-md-12 mb-5">
        <label class="form-label">{{ __('app.name') }}:</label>
        <input name="name" type="text" wire:model="newexpert.name"
            class="form-control @error('name') is-invalid @enderror form-control-solid mb-2 mb-md-0"
            placeholder="{{ __('app.enter_expert_name') }}"
            value="{{ old('name')}}" />
        @error('name')
            <div class=" invalid-feedback fv-plugins-message-container">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-4 mb-5">
        <label class="form-label">{{ __('app.phone') }}:</label>
        <input name="phone" type="text" wire:model="newexpert.phone"
            class="form-control @error('phone') is-invalid @enderror form-control-solid mb-2 mb-md-0"
            placeholder="{{ __('app.enter_expert_phone') }}"
            value="{{ old('phone') }}" />
        @error('phone')
            <div class=" invalid-feedback fv-plugins-message-container">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-8 mb-5">
        <label class="form-label">{{ __('app.email') }}:</label>
        <input name="email" type="text" wire:model="newexpert.email"
            class="form-control @error('email') is-invalid @enderror form-control-solid mb-2 mb-md-0"
            placeholder="{{ __('app.enter_expert_email') }}"
            value="{{ old('email') }}" />
        @error('email')
            <div class=" invalid-feedback fv-plugins-message-container">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-6 mb-5">
        <label class="form-label">{{ __('app.type') }}:</label>
        <select name="category" wire:model="newexpert.category" data-control="select2"
            class="form-select @error('category') is-invalid @enderror form-select-solid mb-2 mb-md-0"
            data-placeholder="{{ __('app.select_expert_type') }}">
            <option></option>
            <option value="main" @if ((old('category')) == 'main') selected @endif>{{ __('app.main') }}</option>
            <option value="certified" @if ((old('category')) == 'certified') selected @endif>{{ __('app.certified') }}
            </option>
            <option value="assistant" @if ((old('category')) == 'assistant') selected @endif>{{ __('app.assistant') }}
            </option>
            <option value="external" @if ((old('category')) == 'external') selected @endif>
                {{ __('app.external-expert') }}</option>
            <option value="external-assistant" @if ((old('category')) == 'external-assistant') selected @endif>
                {{ __('app.external-assistant') }}</option>
        </select>
        @error('category')
            <div class=" invalid-feedback fv-plugins-message-container">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-6 mb-5">
        <label class="form-label">{{ __('app.field') }}:</label>
        <select name="field" wire:model="newexpert.field" data-control="select2"
            class="form-select @error('field') is-invalid @enderror form-select-solid mb-2 mb-md-0"
            data-placeholder="{{ __('app.select_expert_field') }}">
            <option></option>
            @foreach (config('system.experts.fields') as $key => $field)
                <option value="{{ $key }}" @if ((old('field')) == $key) selected @endif>
                    {{ __('app.' . $field) }}</option>
            @endforeach
        </select>
        @error('field')
            <div class=" invalid-feedback fv-plugins-message-container">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
