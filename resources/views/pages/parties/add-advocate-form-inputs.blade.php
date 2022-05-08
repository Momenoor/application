@csrf
<div class="modal-header">
    <h5 class="modal-title">{{ __('app.add_party') }}</h5>

    <!--begin::Close-->
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <span class="svg-icon svg-icon-2x"></span>
    </div>
    <!--end::Close-->
</div>

<div class="modal-body">
    <div class="row mb-10">
        <div class="col-md-8 mb-5">
            <label class="form-label">{{ __('app.name') }}:</label>
            <input name="newsubparty[name]" type="text" wire:model="newsubparty.name"
                class="form-control @error('newsubparty.name') is-invalid @enderror form-control-solid mb-2 mb-md-0"
                placeholder="{{ __('app.enter_party_name') }}" value="{{ old('newsubparty.name') }}" />
            @error('newsubparty.name')
                <div class=" invalid-feedback fv-plugins-message-container">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-4 mb-5">

            <!--begin::Label-->
            <label class="d-flex align-items-center form-label">
                {{ __('app.type') }}:
            </label>
            <!--end::Label-->
            <div class="d-flex mt-4">
                <!--begin::Buttons-->
                <div class="form-check form-check-custom form-check-solid form-check-lg me-10">
                    <input  wire.ignore class="form-check-input" wire:model="newsubparty.type" name="newsubparty[type]" type="radio" value="office"
                        />
                    <label class="form-check-label" for="flexCheckboxLg">
                        {{ __('app.office') }}
                    </label>
                </div>
                <div class="form-check form-check-custom form-check-solid form-check-lg me-10">
                    <input  wire.ignore class="form-check-input" wire:model="newsubparty.type" type="radio" name="newsubparty[type]" value="advocate"
                        />
                    <label class="form-check-label" for="flexCheckboxLg" >
                        {{ __('app.advocate') }}
                    </label>
                </div>
                <!--end::Input wrapper-->
            </div>
            <!--end::Radio group-->
        </div>
        <div class="col-md-3 mb-5">
            <label class="form-label">{{ __('app.phone') }}:</label>
            <input name="newsubparty[phone]" type="text" wire:model="newsubparty.phone"
                class="form-control @error('newsubparty.phone') is-invalid @enderror form-control-solid mb-2 mb-md-0"
                placeholder="{{ __('app.enter_party_phone') }}" value="{{ old('newsubparty.phone') }}" />
            @error('newsubparty.phone')
                <div class=" invalid-feedback fv-plugins-message-container">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-3 mb-5">
            <label class="form-label">{{ __('app.fax') }}:</label>
            <input name="newsubparty[fax]" type="text" wire:model="newsubparty.fax"
                class="form-control @error('newsubparty.fax') is-invalid @enderror form-control-solid mb-2 mb-md-0"
                placeholder="{{ __('app.enter_party_fax') }}" value="{{ old('newsubparty.fax') }}" />
            @error('newsubparty.fax')
                <div class=" invalid-feedback fv-plugins-message-container">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-6 mb-5">
            <label class="form-label">{{ __('app.email') }}:</label>
            <input name="newsubparty[email]" type="text" wire:model="newsubparty.email"
                class="form-control @error('newsubparty.email') is-invalid @enderror form-control-solid mb-2 mb-md-0"
                placeholder="{{ __('app.enter_party_email') }}" value="{{ old('newsubparty.email') }}" />
            @error('newsubparty.email')
                <div class=" invalid-feedback fv-plugins-message-container">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-12 mb-5">
            <label class="form-label">{{ __('app.address') }}:</label>
            <textarea name="newsubparty[address]" type="text" wire:model="newsubparty.address"
                class="form-control @error('newsubparty.address') is-invalid @enderror form-control-solid mb-2 mb-md-0"
                placeholder="{{ __('app.enter_party_address') }}">{{ old('newsubparty.address') }}</textarea>
            @error('newsubparty.address')
                <div class=" invalid-feedback fv-plugins-message-container">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
