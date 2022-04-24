<div class="modal fade" tabindex="-1" id="addClaimModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('claims.add-from-matter', $matter) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('app.add_claim') }}</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="col-12">
                        <div class="mb-10 row">
                            <div class="col-12  mb-5 fv-plugins-bootstrap5-row-invalid">
                                <label class="required form-label">{{ __('app.amount') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div class="input-group input-group-solid">
                                    <input type="text" name="claim[amount]"
                                        class="form-control @error('claim.amount') is-invalid @enderror form-control-solid"
                                        placeholder="{{ __('app.claim_amount') }}"
                                        value="{{ old('claim.amount') }}" />
                                    <!--end::Input-->
                                    <span class="input-group-text">AED</span>
                                </div>
                                @error('claim.amount')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <!--begin::Description-->
                            </div>
                        </div>
                        <div class="mb-10 row">
                            <div class="col-6 mb-5">
                                <label class="required form-label">{{ __('app.type') }}</label>
                                <div>
                                    <select id="claimType" name="claim[type]"
                                        class="form-select @error('claim.type') is-invalid @enderror form-select-solid"
                                        data-hide-search="true" data-control="select2"
                                        data-placeholder="{{ __('app.select_a_type') }}">
                                        <option></option>
                                        @foreach ($claimsTypes as $id => $type)
                                            @if ($type['active'])
                                                <option value="{{ $id }}"
                                                    {{ old('claim.type') == $id ? 'selected' : '' }}>
                                                    {{ __('app.' . $id) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @error('claim.type')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="required form-label">{{ __('app.recurring') }}</label>
                                <div>
                                    <select name="claim[recurring]" id="claimRecurring"
                                        class="form-select @error('claim.recurring') is-invalid @enderror form-select-solid"
                                        data-hide-search="true" data-control="select2"
                                        data-placeholder="{{ __('app.select_recurring') }}">
                                        <option></option>
                                        @foreach (data_get($claimsTypes, 'recurring.values') as $id => $recurring)
                                            <option value="{{ $id }}"
                                                {{ old('claim.recurring') == $id ? 'selected' : '' }}>
                                                {{ __('app.' . $id) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('claim.recurring')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex flex-stack">
                                <div>
                                    <label
                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mt-8 mb-5">
                                        <span
                                            class="form-check-label me-10 ms-0 fw-bolder fs-6 text-gray-700">{{ __('app.taxable') }}?</span>
                                        <input name="taxable" class="form-check-input" value="on"
                                            {{ old('taxable') == 'on' ? 'checked' : '' }} type="checkbox">
                                    </label>
                                </div>
                            </div>
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
