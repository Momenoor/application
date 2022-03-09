<div>
    <div class="row mb-5">
        <div class="col-4">
            <label
                class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mt-12 mb-5">
                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">Marketing Commission?</span>
                <input class="form-check-input" name="has_marketing_commission" value="1" wire:model="hasMarketingCommission" type="checkbox">
            </label>
        </div>
        @if ($hasMarketingCommission)
            <div class="col-8">
                <label class="form-label">{{ __('app.marketing-rep') }}</label>
                <!--end::Label-->
                <!--begin::Select-->
                <div wire:ignore>
                    <select id="marketingRep" data-placeholder="Select marketing-rep"
                        class="form-select form-select-solid" name="parties[marketing][name]">
                        <option value=""></option>
                        <option data-kt-flag="flags/united-states.svg" value="USD">
                            <b>USD</b>&#160;-&#160;USA dollar
                        </option>
                        <option data-kt-flag="flags/united-kingdom.svg" value="GBP">
                            <b>GBP</b>&#160;-&#160;British pound
                        </option>
                        <option data-kt-flag="flags/australia.svg" value="AUD">
                            <b>AUD</b>&#160;-&#160;Australian dollar
                        </option>
                        <option data-kt-flag="flags/japan.svg" value="JPY">
                            <b>JPY</b>&#160;-&#160;Japanese yen
                        </option>
                        <option data-kt-flag="flags/sweden.svg" value="SEK">
                            <b>SEK</b>&#160;-&#160;Swedish krona
                        </option>
                        <option data-kt-flag="flags/canada.svg" value="CAD">
                            <b>CAD</b>&#160;-&#160;Canadian dollar
                        </option>
                        <option data-kt-flag="flags/switzerland.svg" value="CHF">
                            <b>CHF</b>&#160;-&#160;Swiss franc
                        </option>
                    </select>
                    <input type="hidden" name="parties[marketing][type]" value="marketing_rep">
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-4">
            <label
                class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mt-12 mb-5">
                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">External Commission?</span>
                <input class="form-check-input" name="has_external_commission" value="1" wire:model="hasExternalCommission" type="checkbox">
            </label>
        </div>
        @if ($hasExternalCommission)
            <div class="col-6">
                <label class="form-label w-100">{{ __('app.thirdparty') }}
                    <a href="javascript:;" wire:click="showModal" class="fw-light text-active-dark float-end"
                        data-bs-toggle="modal" data-bs-target="#kt_thirdparty_modal">add
                        new</a>
                </label>
                <!--end::Label-->
                <!--begin::Select-->
                <select id="thirdparty" data-placeholder="Select thirdparty" wire:model="selectedThirdParty"
                    class="form-select form-select-solid" name="parties[third_party][name]">
                    <option value=""></option>
                    @foreach ($thirdPartiesList as $id => $thirdPartyName)
                        <option value="{{ $id }}">{{ $id }} - {{ $thirdPartyName }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="parties[third_party][type]" value="third_party">
            </div>
            <div class="col-2">
                <label class="form-label fw-bolder fs-6 text-gray-700">{{ __('app.percent') }}</label>
                <div class="input-group input-group-solid">
                    <input type="text" name="external_commission_percent" class="form-control">
                    <span class="input-group-text" id="basic-addon2">%</span>
                </div>
            </div>
        @endif
    </div>
    <div class="separator separator-dashed my-10"></div>
    <div class="row">
        <div class="col-12">
            <div class="mb-10 row">
                <div class="col-5">
                    <label class="required form-label">Amount</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <div class="input-group input-group-solid mb-5">
                        <input type="text" wire:model.lazy="claim.amount"
                            class="form-control form-control-solid" placeholder="Claim amount" />
                        <!--end::Input-->
                        <span class="input-group-text">AED</span>
                    </div>
                    <!--begin::Description-->
                </div>
                <div class="col-4">
                    <label class="required form-label">Type</label>
                    <div wire:ignore>
                        <select id="claimType" class="form-select form-select-solid" wire:model="claim.type"
                            data-hide-search="true" data-control="select2" data-placeholder="Select an option">
                            <option></option>
                            @foreach ($claimsTypes as $id => $type)
                                @if ($type['display'])
                                    <option value="{{ $id }}">{{ $type['name'] }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <label class="required form-label">Recurring</label>
                    <div wire:ignore>
                        <select id="claimRecurring" class="form-select form-select-solid" wire:model="claim.recurring"
                            data-hide-search="true" data-control="select2" data-placeholder="Select an option">
                            <option></option>
                            @foreach ($claimsTypes['recurring']['values'] as $id => $recurring)
                                <option value="{{ $id }}">{{ $recurring['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex flex-stack">
                    <div>
                        <label
                            class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mt-8 mb-5">
                            <span class="form-check-label me-10 ms-0 fw-bolder fs-6 text-gray-700">Taxable?</span>
                            <input class="form-check-input" wire:model="claim.taxable" type="checkbox">
                        </label>
                    </div>
                    <div>
                        <button type="button" wire:click="addClaim" class="btn btn-sm btn-primary">Add Claim</button>
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
                            <th class="min-w-175px">Amount</th>
                            <th class="min-w-100px">Type</th>
                            <th class="min-w-100px">Recurring</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                        @foreach ($claims as $key => $claim)
                            <tr>
                                <td>
                                    <a href="javascript:;" class="btn btn-icon btn-light-danger w-30px h-30px me-3"
                                        wire:click="removeClaim({{ $key }})"
                                        data-kt-customer-payment-method="delete" data-bs-original-title="Delete">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
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
                                    <input type="hidden" name="claims[{{ $key }}][amount]"
                                        value="{{ $claim['amount'] }}">
                                </td>
                                <td>
                                    <div class="badge badge-{{ $claim['type']['color'] }}">
                                        {{ $claim['type']['name'] }}</div>
                                    <input type="hidden" name="claims[{{ $key }}][type]"
                                        value="{{ $claim['type']['id'] }}">
                                </td>
                                <td>
                                    <div class="badge badge-light-{{ $claim['recurring']['color'] }}">
                                        {{ $claim['recurring']['name'] }}
                                    </div>
                                    <input type="hidden" name="claims[{{ $key }}][recurring]"
                                        value="{{ $claim['recurring']['name'] }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <!--end::Table head-->
                </table>
                <!--end::Table-->
            </div>
        </div>
    </div>
    <div class="modal fade" wire:ignore.self tabindex="-1" id="kt_thirdparty_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">add new third-party</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <p>
                    <div class="row">
                        <div class="col-12">
                            @include('pages.thirdparties.form.create',['isLivewire'=>true,'dropdownParent'=>"$('#kt_thirdparty_modal')"])
                        </div>
                    </div>
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" wire:click="resetThirdPartyForm"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" data-bs-dismiss="modal" wire:click="storeThirdParty"
                        class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener("livewire:load", () => {

            initSelect()
            Livewire.hook('message.processed', (message, component) => {
                initSelect()
                $("#marketingRep").on('change', function(e) {
                    //validator.revalidateField($(this).attr('name'));
                    @this.set('selectedMarketingRep', $("#marketingRep").select2("val"))
                })
                $("#thirdparty").on('change', function(e) {
                    //validator.revalidateField($(this).attr('name'));
                    Livewire.emit('selectThirpParty', $("#thirdparty").select2("val"));
                })
                $("#thirdparty.bankName").on('change', function(e) {
                    //validator.revalidateField($(this).attr('name'));
                    @this.set('thirdpartyBankName', $("#thirdparty.bankName").select2("val"))
                })
                $("#claimType").on('change', function(e) {
                    //validator.revalidateField($(this).attr('name'));
                    @this.set('claim.type', $("#claimType").select2("val"))
                })
                $("#claimRecurring").on('change', function(e) {
                    //validator.revalidateField($(this).attr('name'));
                    @this.set('claim.recurring', $("#claimRecurring").select2("val"))
                })
            })

            function initSelect() {
                $("#marketingRep").select2()
                $("#thirdparty").select2()
                $('#thirdparty.bankName').select2()
                $('#claimType').select2({
                    minimumResultsForSearch: Infinity
                })
                $('#claimRecurring').select2({
                    minimumResultsForSearch: Infinity
                })
            }
        })
    </script>
@endpush
