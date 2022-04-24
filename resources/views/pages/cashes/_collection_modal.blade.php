<div class="modal fade" tabindex="-1" id="collectionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('app.collect_matter_claim') }}</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>
            <form action="{{ route('cash.collect', $matter) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-10">
                        <div class="col-12">
                            <label class="required form-label">{{ __('app.amount') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="input-group input-group-solid">
                                <input type="text" name="cash[amount]"
                                    class="form-control @error('cash.amount') is-invalid @enderror form-control-solid"
                                    placeholder="{{__('app.enter').' '.__('app.amount')}}" value="{{old('cash.amount')}}"/>
                                <!--end::Input-->
                                <span class="input-group-text">AED</span>
                            </div>
                            @error('cash.amount')
                                <div class="fv-plugins-message-container invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-12">
                            <label class="required form-label">{{ __('app.description') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="cash[description]" class="form-control @error('cash.description') is-invalid @enderror form-control-solid"
                                placeholder="{{__('app.enter').' '.__('app.description')}}">{{old('cash.description')}}</textarea>
                            <!--end::Input-->
                        </div>
                        @error('cash.description')
                            <div class="fv-plugins-message-container invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                        data-bs-dismiss="modal">{{ __('app.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('app.collect') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
