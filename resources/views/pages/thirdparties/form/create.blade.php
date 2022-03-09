<div class="row">
    <div class="col-12">
        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.thirdparty.name') }}</label>
        <div class="mb-5">
            <input type="text" id="thirdparty-name"
                @if (isset($isLivewire) && $isLivewire) wire:model="thirdparty.name" @else name="name" @endif
                class="form-control form-control-solid" placeholder="Third-party Name">
        </div>
    </div>
    <div class="col-6">
        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.thirdparty.name') }}</label>
        <div class="mb-5">
            <input type="text" id="thirdparty-phone"
                @if (isset($isLivewire) && $isLivewire) wire:model="thirdparty.phone" @else name="phone" @endif
                class="form-control form-control-solid" placeholder="Third-party Phone">
        </div>
    </div>
    <div class="col-6">
        <label class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.thirdparty.email') }}</label>
        <div class="mb-5">
            <input type="text" id="thirdparty-email"
                @if (isset($isLivewire) && $isLivewire) wire:model="thirdparty.email" @else name="email" @endif
                class="form-control form-control-solid" placeholder="Third-party Email">
        </div>
    </div>
    <div class="separator separator-dashed my-5"></div>
    <label for="" class="col-12 fs-base fw-bolder mb-5">Bank Details</label>
    <div class="col-6">
        <label
            class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.thirdparty.bank-account-name') }}</label>
        <div class="mb-5">
            <input type="text" id="thirdparty.bankAccountName"
                @if (isset($isLivewire) && $isLivewire) wire:model="thirdparty.bankAccountName" @else name="bank_account_name" @endif
                class="form-control form-control-solid" placeholder="Third-party Bank Account Name">
        </div>
    </div>
    <div class="col-6">
        <label
            class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('app.thirdparty.bank-account-name') }}</label>
        <div class="mb-5">
            <select id="thirdparty.bankName" @if (isset($isLivewire) && $isLivewire) wire:model="thirdparty.bankName" @else name="bank_name" @endif aria-label="Select a Bank Name"
                data-placeholder="Select Bank Name" class="form-select form-select-solid mb-5 mb-md-0"
                data-control="select2">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
    </div>
    <div class="col-12">
        <div class="input-group input-group-solid mb-5">
            <span class="input-group-text" id="basic-addon1">IBAN</span>
            <input type="text" class="form-control"  @if (isset($isLivewire) && $isLivewire) wire:model="thirdparty.IBAN" @else name="bank_iban" @endif placeholder="IBAN" aria-label="Username"
                aria-describedby="basic-addon1" />
        </div>
    </div>
</div>
