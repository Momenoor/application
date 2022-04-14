<div class="col-lg-4">
    <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mt-12 mb-5">
        <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{__('app.marketing-commission')}}</span>
        <input class="form-check-input" name="has_marketing_commission" value="1" wire:model="hasMarketingCommission"
            type="checkbox">
    </label>
</div>
@if ($hasMarketingCommission)
    <div class="col-lg-8">
        <label class="form-label">{{ __('app.marketing-rep') }}</label>
        <!--end::Label-->
        <!--begin::Select-->
        <div>
            <select id="marketer" data-placeholder="{{__('app.select_marketer')}}"
                class="form-select @error('marketing.marketer.id') is-invalid @enderror form-select-solid"
                wire:model="marketing.marketer.id" data-control="select2" name="parties[marketing][id]">
                <option value=""></option>
                @foreach ($marketersList as $marketer)
                    <option value="{{ $marketer['id'] }}">{{ $marketer['id'] }}
                        -
                        {{ $marketer['display_name'] }}
                    </option>
                @endforeach
            </select>
            @error('marketing.marketer.id')
                <div class="invalid-feedback fv-plugins-message-container">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
@endif
