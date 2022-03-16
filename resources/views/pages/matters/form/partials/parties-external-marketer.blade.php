<div class="col-4">
    <label
        class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mt-12 mb-5">
        <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">External
            Commission?</span>
        <input class="form-check-input" name="has_external_commission" value="1"
            wire:model="hasExternalCommission" type="checkbox">
    </label>
</div>
@if ($hasExternalCommission)
    <div class="col-6">
        <label class="form-label w-100">{{ __('app.external-marketer') }}
            <a href="javascript:;" wire:click="showModal"
                class="fw-light text-active-dark float-end" data-bs-toggle="modal"
                data-bs-target="#kt_thirdparty_modal">add
                new</a>
        </label>
        <!--end::Label-->
        <!--begin::Select-->
        <select id="externalMarketer" data-placeholder="Select Marketer"
            wire:model="otherParties.external_markter.id" data-control="select2" class="form-select form-select-solid"
            name="parties[third_party][name]">
            <option value=""></option>
            @foreach ($externalMarketersList as $externalMarketer)
                <option
                    value="{{ $externalMarketer['id'] }}">{{ $externalMarketer['id'] }} -
                    {{ $externalMarketer['name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-2">
        <label
            class="form-label fw-bolder fs-6 text-gray-700">{{ __('app.percent') }}</label>
        <div class="input-group input-group-solid">
            <input type="text" name="matter[external_commission_percent]" wire:model="matter.external_commission_percent" class="form-control">
            <span class="input-group-text" id="basic-addon2">%</span>
        </div>
    </div>
@endif


