<div class="col-12">
    <div class="mb-10 row">
        <div class="col-5  mb-5 fv-plugins-bootstrap5-row-invalid">
            <label class="required form-label">{{ __('app.amount') }}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <div class="input-group input-group-solid">
                <input type="text" wire:model="claim.amount"
                    class="form-control @error('claim.amount') is-invalid @enderror form-control-solid"
                    placeholder="Claim amount" />
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
        <div class="col-4 mb-5">
            <label class="required form-label">{{ __('app.type') }}</label>
            <div>
                <select id="claimType" class="form-select @error('claim.type') is-invalid @enderror form-select-solid"
                    wire:model="claim.type" data-hide-search="true" data-control="select2"
                    data-placeholder="Select an option">
                    <option></option>
                    @foreach ($claimsTypes as $id => $type)
                        @if ($type['display'])
                            <option value="{{ $id }}">{{ __('app.' . $id) }}</option>
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
        <div class="col-3">
            <label class="required form-label">{{ __('app.recurring') }}</label>
            <div>
                <select id="claimRecurring"
                    class="form-select @error('claim.recurring') is-invalid @enderror form-select-solid"
                    wire:model="claim.recurring" data-hide-search="true" data-control="select2"
                    data-placeholder="Select an option">
                    <option></option>
                    @foreach (data_get($claimsTypes, 'recurring.values') as $id => $recurring)
                        <option value="{{ $id }}">{{ __('app.' . $id) }}</option>
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
                    <input class="form-check-input" wire:model="claim.taxable" type="checkbox">
                </label>
            </div>
            <div>
                <button type="button" wire:click="addClaim"
                    class="btn btn-sm btn-primary">{{ __('app.add-claim') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-2 mb-0">
            <!--begin::Table head-->
            <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th class="min-w-70px">#</th>
                    <th class="min-w-175px">{{ __('app.amount') }}</th>
                    <th class="min-w-100px">{{ __('app.type') }}</th>
                    <th class="min-w-100px">{{ __('app.recurring') }}</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="fw-bold text-gray-600">
                @foreach ($claims as $key => $claim)
                    <tr>
                        <td>
                            <a href="javascript:;" class="btn btn-icon btn-light-danger w-30px h-30px me-3"
                                wire:click="removeClaim({{ $key }})">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                            fill="black"></path>
                                        <path opacity="0.5"
                                            d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                            fill="black"></path>
                                        <path opacity="0.5"
                                            d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                        </td>
                        <td>
                            {{ $claim['amount'] }}
                        </td>
                        <td>
                            <div class="badge badge-{{ data_get($claim, 'type.color') }}">
                                {{ data_get($claim, 'type.name') }}</div>
                        </td>
                        <td>
                            <div class="badge badge-light-{{ data_get($claim, 'recurring.color') }}">
                                {{ data_get($claim, 'recurring.name') }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <!--end::Table head-->
        </table>
        <!--end::Table-->
    </div>
</div>
