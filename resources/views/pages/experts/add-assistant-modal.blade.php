<div class="modal fade" tabindex="-1" id="addAssistantModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('expert.assign-assistant', $matter) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.assign_assistant') }}</h5>

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
                            <label class="required form-label">{{ __('app.assistant') }}</label>
                            <div>
                                <select name="expert[assistant]" id="assistant"
                                    class="form-select @error('expert.assistant') is-invalid @enderror form-select-solid"
                                    data-hide-search="true" data-control="select2"
                                    data-placeholder="{{ __('app.select_assistant') }}">
                                    <option></option>
                                    @foreach ($assistants as $assistant)
                                        <option value="{{ $assistant->id }}"
                                            {{ old('expert.assistant') == $assistant->id ? 'selected' : '' }}>
                                            {{ $assistant->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('expert.assistant')
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
                    <button type="submit" class="btn btn-primary">{{ __('app.assign') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
