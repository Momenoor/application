<div class="col-lg-12 mb-10">
    @foreach ($parties as $index => $party)
        <div class="form-group row mb-5">
            <div class="col-md-4 mb-5">
                <label class="form-label">{{ __('app.type') }}:</label>
                <select name="parties[{{ $index }}][type]" aria-label="Select a Type"
                    data-placeholder="{{__('app.select_type')}}"
                    class="form-select @error('parties.'. $index .'.type') is-invalid @enderror form-select-solid mb-5 mb-md-0 party-type"
                    data-control="select2" data-row-index="{{ $index }}"
                    wire:model="parties.{{ $index }}.type">
                    <option value=""></option>
                    @foreach ($partyTypes as $id => $type)
                        <option value="{{ $id }}">
                            {{ __('app.' . $type['text']) }}
                        </option>
                    @endforeach
                </select>
                @error('parties.'. $index .'.type')
                    <div class="invalid-feedback fv-plugins-message-container">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-8 mb-5">
                <label class="form-label">{{ __('app.name') }}:</label>
                <input name="parties.{{ $index }}.name" wire:model="parties.{{ $index }}.name"
                    type="text" class="form-control @error('parties.'. $index .'.name') is-invalid @enderror form-control-solid mb-2 mb-md-0" placeholder="{{__('app.enter_party_name')}}" />
                    @error('parties.'. $index .'.name')
                    <div class="invalid-feedback fv-plugins-message-container">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">{{ __('app.phone') }}:</label>
                <input name="parties.{{ $index }}.phone" wire:model="parties.{{ $index }}.phone"
                    type="text" class="form-control @error('parties.'. $index .'.phone') is-invalid @enderror form-control-solid mb-2 mb-md-0"
                    placeholder="{{__('app.enter_party_number')}}" />
                    @error('parties.'. $index .'.phone')
                    <div class="invalid-feedback fv-plugins-message-container">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">{{ __('app.email') }}:</label>
                <input name="parties.{{ $index }}.email" wire:model="parties.{{ $index }}.email"
                    type="text" class="form-control @error('parties.'. $index .'.email') is-invalid @enderror form-control-solid mb-2 mb-md-0"
                    placeholder="{{__('app.enter_party_email')}}" />
                    @error('parties.'. $index .'.email')
                    <div class="invalid-feedback fv-plugins-message-container">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            @if (!$loop->first)
                <div class="col-md-4">
                    <a href="javascript:;" wire:click="removeParty({{ $index }})"
                        class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                        <i class="la la-trash-o fs-3"></i>{{__('app.delete')}}
                    </a>
                </div>
            @endif
            @include(
                'pages.matters.form.partials.parties-sub-parties'
            )
        </div>
        @if (!$loop->last)
            <div class="separator separator-dashed my-5"></div>
        @endif
    @endforeach
    <!--end::Form group-->
    <div class="separator separator-dashed my-5"></div>
    <div class="form-group">
        <a href="javascript:;" class="btn btn-sm btn-block btn-warning col-12" wire:click="addParty">
            <i class="la la-plus"></i>{{ __('app.add') }}
        </a>
    </div>
</div>
