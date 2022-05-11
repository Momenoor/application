@csrf
<div class="modal-header">
    <h5 class="modal-title">{{ __('app.add_expert') }}</h5>

    <!--begin::Close-->
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <span class="svg-icon svg-icon-2x"></span>
    </div>
    <!--end::Close-->
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12 mb-5">
            <label class="form-label">{{ __('app.name') }}:</label>
            <input name="newexpert[name]" type="text" wire:model="newexpert.name"
                class="form-control @error('newexpert.name') is-invalid @enderror form-control-solid mb-2 mb-md-0"
                placeholder="{{ __('app.enter_expert_name') }}" value="{{ old('newexpert.name') }}" />
            @error('newexpert.name')
                <div class=" invalid-feedback fv-plugins-message-container">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-4 mb-5">
            <label class="form-label">{{ __('app.phone') }}:</label>
            <input name="newexpert[phone]" type="text" wire:model="newexpert.phone"
                class="form-control @error('newexpert.phone') is-invalid @enderror form-control-solid mb-2 mb-md-0"
                placeholder="{{ __('app.enter_expert_phone') }}" value="{{ old('newexpert.phone') }}" />
            @error('newexpert.phone')
                <div class=" invalid-feedback fv-plugins-message-container">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-8 mb-5">
            <label class="form-label">{{ __('app.email') }}:</label>
            <input name="newexpert[email]" type="text" wire:model="newexpert.email"
                class="form-control @error('newexpert.email') is-invalid @enderror form-control-solid mb-2 mb-md-0"
                placeholder="{{ __('app.enter_expert_email') }}" value="{{ old('newexpert.email') }}" />
            @error('newexpert.email')
                <div class=" invalid-feedback fv-plugins-message-container">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.type') }}:</label>
            <select name="newexpert[category]" wire:model="newexpert.category" data-control="select2"
                class="form-select @error('newexpert.category') is-invalid @enderror form-select-solid mb-2 mb-md-0"
                data-placeholder="{{ __('app.select_expert_type') }}">
                <option></option>
                <option value="main">{{ __('app.main') }}</option>
                <option value="certified">{{ __('app.certified') }}</option>
                <option value="assistant">{{ __('app.assistant') }}</option>
                <option value="external">{{ __('app.external-expert') }}</option>
                <option value="external-assistant">{{ __('app.external-assistant') }}</option>
            </select>
            @error('newexpert.category')
                <div class=" invalid-feedback fv-plugins-message-container">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.field') }}:</label>
            <select name="newexpert[field]" wire:model="newexpert.field" data-control="select2"
                class="form-select @error('newexpert.field') is-invalid @enderror form-select-solid mb-2 mb-md-0"
                data-placeholder="{{ __('app.select_expert_field') }}">
                <option></option>
                @foreach (config('system.experts.fields') as $key => $field)
                    <option value="{{ $key }}">{{ __('app.' . $field) }}</option>
                @endforeach
            </select>
            @error('newexpert.field')
                <div class=" invalid-feedback fv-plugins-message-container">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
