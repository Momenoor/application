<div class="modal fade" tabindex="-1" id="rejectRequestModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('request.reject', ['request'=>$model]) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.reject_request') }}</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <input type="hidden" name="request[status]" value="rejected" />
                <div class="modal-body">
                    <div class="row mb-10">
                        <div class="col-12">
                            <label class="form-label">{{ __('app.reject_comment') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="request[approved_comment]"
                                      class="@error('request.approved_comment') is-invalid @enderror form-control  form-control-solid"
                                      placeholder="{{ __('app.please_insert') . ' ' . __('app.reject_comment') }}">{{ old('request.approved_comment','') }}</textarea>
                            @error('request.approved_comment')
                            <div class="fv-plugins-message-container invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="dropzone">
                            <!--begin::Message-->
                            <div class="dz-message needsclick">
                                <i class="fas fa-upload fs-3x text-primary"></i>

                                <!--begin::Info-->
                                <div class="ms-4 text-start">
                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">اسحب الملفات هنا، أو اضغط لاختيار
                                        الملفات..</h3>
                                </div>
                                <input type="hidden" name="request[uploaded_file_path]" id="uploaded_file_path">
                                <!--end::Info-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light"
                            data-bs-dismiss="modal">{{ __('app.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('app.reject') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

