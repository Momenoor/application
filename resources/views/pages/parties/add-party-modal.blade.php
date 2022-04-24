<div class="modal fade" tabindex="-1" id="addPartyModal">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <form action="{{ route('party.add-party', $matter) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.add_party_to_matter') }}</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="form-group row mb-5">
                        <div class="col-md-4 mb-5">
                            <label class="form-label">{{ __('app.type') }}:</label>
                            <select name="party[type]" aria-label="Select a Type"
                                data-placeholder="{{ __('app.select_type') }}"
                                class="form-select @error('party.type') is-invalid @enderror form-select-solid mb-5 mb-md-0 party-type"
                                data-control="select2">
                                <option value=""></option>
                                @foreach ($partiesTypes as $id => $type)
                                    <option value="{{ $id }}"
                                        @if ($id == old('party.type')) selected @endif>
                                        {{ __('app.' . $type['text']) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('party.type')
                                <div class="invalid-feedback fv-plugins-message-container">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-8 mb-5">
                            <label class="form-label">{{ __('app.name') }}:</label>
                            <input name="party[name]" type="text"
                                class="form-control @error('party.name') is-invalid @enderror form-control-solid mb-2 mb-md-0"
                                placeholder="{{ __('app.enter_party_name') }}" value="{{ old('party.name') }}" />
                            @error('party.name')
                                <div class=" invalid-feedback fv-plugins-message-container">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ __('app.phone') }}:</label>
                            <input name="party[phone]" type="text"
                                class="form-control @error('party.phone') is-invalid @enderror form-control-solid mb-2 mb-md-0"
                                placeholder="{{ __('app.enter_party_number') }}"
                                value="{{ old('party.phone') }}" />
                            @error('party.phone')
                                <div class="invalid-feedback fv-plugins-message-container">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">{{ __('app.email') }}:</label>
                            <input name="party[email]" type="text"
                                class="form-control @error('party.email') is-invalid @enderror form-control-solid mb-2 mb-md-0"
                                placeholder="{{ __('app.enter_party_email') }}"
                                value="{{ old('party.email') }}" />
                            @error('party.email')
                                <div class="  invalid-feedback fv-plugins-message-container">
                                    {{ $message }}
                                </div>
                            @enderror
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
