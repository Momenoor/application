<div class="modal fade" tabindex="-1" id="changeDatesModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('procedure.change-date', $matter) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.change_date') }}</h5>

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
                            <label class="form-label">{{ __('app.date_to_be_changed') }}:</label>
                            <select name="procedure[type]" aria-label="Select a Type"
                                data-placeholder="{{ __('app.select_type') }}"
                                class="form-select @error('procedure.type') is-invalid @enderror form-select-solid mb-5 mb-md-0 procedure-type"
                                data-control="select2">
                                <option value=""></option>
                                <option value="received_date" @if ('received_date' == old('procedure.type')) selected @endif>
                                    {{ __('app.received_date') }}
                                </option>
                                @if ($matter->isReported())
                                    <option value="reported_date" @if ('reported_date' == old('procedure.type')) selected @endif>
                                        {{ __('app.reported_date') }}
                                    </option>
                                @endif
                                @if ($matter->isSubmitted())
                                    <option value="submitted_date" @if ('submitted_date' == old('procedure.type')) selected @endif>
                                        {{ __('app.submitted_date') }}
                                    </option>
                                @endif
                                <option value="last_action_date" @if ('received_date' == old('procedure.type')) selected @endif>
                                    {{ __('app.last_action_date') }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-12">
                            <label class="required form-label">{{ __('app.date') }}</label>
                            <!--end::Label-->
                            <input type="text" name="procedure[datetime]" data-control="flatpickr"
                                class="form-control @error('procedure.datetime') is-invalid @enderror form-control-solid"
                                placeholder="{{ __('app.please_select') . ' ' . __('app.date') }}"
                                value="{{ old('procedure.datetime') }}">
                            @error('procedure.datetime')
                                <div class="fv-plugins-message-container invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <!--end::Input-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light"
                        data-bs-dismiss="modal">{{ __('app.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('app.set') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
