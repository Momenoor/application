<div class="modal fade" tabindex="-1" id="addNextSessionDateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('procedure.next-session', $matter) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.add_next_session_date') }}</h5>

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
                            <label class="required form-label">{{ __('app.next-session-date') }}</label>
                            <!--end::Label-->
                            <input type="text" name="procedure[datetime]" data-control="flatpickr"
                                class="form-control @error('procedure.datetime') is-invalid @enderror form-control-solid"
                                placeholder="{{ __('app.please_select') . ' ' . __('app.next-session-date') }}"
                                value="{{ old('procedure.datetime') }}">
                            @error('procedure.datetime')
                                <div class="fv-plugins-message-container invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-12">
                            <label class="required form-label">{{ __('app.description') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="procedure[description]"
                                class="@error('procedure.description') is-invalid @enderror form-control  form-control-solid"
                                placeholder="{{ __('app.please_insert') . ' ' . __('app.description') }}">{{ old('procedure.description','') }}</textarea>
                            @error('procedure.description')
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
                    <button type="submit" class="btn btn-primary">{{ __('app.add') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
