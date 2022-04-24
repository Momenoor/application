<div class="modal fade" tabindex="-1" id="addAdvocateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('party.link-subparty', $matter) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.add_advocate') }}</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="row mb-10">
                        <div class="col-12">
                            <!--end::Label-->
                            <label class="required form-label">{{ __('app.party') }}</label>
                            <div>
                                <select name="party[id]" id="partyId"
                                    class="form-select @error('party.id') is-invalid @enderror form-select-solid"
                                    data-hide-search="true" data-control="select2"
                                    data-placeholder="{{ __('app.select_party') }}">
                                    <option></option>
                                    @foreach ($matter->onlyParties as $party)
                                        <option value="{{ $party->id }}"
                                            {{ old('party.id') == $party->id ? 'selected' : '' }}>
                                            {{ $party->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('party.id')
                                <div class="fv-plugins-message-container invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-12">
                            <label class="required form-label">{{ __('app.subparty') }}</label>
                            <div>
                                <select name="party[subparty]" id="partySubparty"
                                    class="form-select @error('party.id') is-invalid @enderror form-select-solid"
                                    data-control="select2" data-placeholder="{{ __('app.select_subparty') }}">
                                    <option></option>
                                    @foreach ($subParties as $party)
                                        <option value="{{ $party->id }}"
                                            {{ old('party.subparty') == $party->id ? 'selected' : '' }}>
                                            {{ $party->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('party.subparty')
                                <div class="fv-plugins-message-container invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light"
                        data-bs-dismiss="modal">{{ __('app.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('app.link_it') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
