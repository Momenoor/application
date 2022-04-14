@if ($party['showAddSubPartyButton'])
    <div class="col-md-12">
        @if (count($party['subParties']) > 0)
            <a href="javascript:;" wire:click="removeAllSubPartyItem({{ $index }})"
                class="btn btn-sm btn-link mt-3 text-danger">
                {{ __('app.remove-party') }}
            </a>
        @else
            <a href="javascript:;" wire:click="addSubParty({{ $index }})" class="btn btn-sm btn-link mt-3">
                {{ __('app.add-party') }}
            </a>
        @endif
        <div class="mt-5 mb-10 ms-10">
            @foreach ($party['subParties'] as $subIndex => $subPartyitem)
                @if ($loop->first)
                    <label class="form-label">{{ __('app.party-name') }}:</label>
                @endif
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="input-group flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select name="parties[{{ $index }}][sub-party][{{ $subIndex }}]"
                                    aria-label="Select a Type" data-placeholder="{{__('app.select_party')}}"
                                    class="form-select @error('parties.' . $index . '.subParties.' . $subIndex) is-invalid @enderror  sub-party-name form-select-solid rounded-end-0 border-end"
                                    data-row-index="{{ $subIndex }}" data-row-parent-index="{{ $index }}"
                                    data-control="select2"
                                    wire:model="parties.{{ $index }}.subParties.{{ $subIndex }}">
                                    <option value=""></option>
                                    @foreach ($advocatesList as $id => $advocate)
                                        <option value="{{ $advocate['id'] }}">
                                            {{ $advocate['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parties.' . $index . '.subParties.' . $subIndex)
                                    <div class="invalid-feedback fv-plugins-message-container">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <a href="javascript:;"
                                class="rounded-start-0 input-group-text border border-secondary btn btn-icon btn-light-danger"
                                wire:click="removeSubParty({{ $index }},{{ $subIndex }})" type="button">
                                <i class="la la-trash-o fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @if ($loop->last)
                    <a href="javascript:;" class="btn btn-sm btn-light-primary"
                        wire:click="addSubParty({{ $index }})" type="button">
                        <i class="la la-plus"></i>
                        {{ __('app.party.add_party') }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
@endif
