<div>
    <div id="matter_create_parties_repeater" class="card card-dashed p-5">
        @foreach ($partiesFormItems as $index => $partyItem)
            <div wire:key="{{ $loop->index . time() . time() }}" class="form-group row mb-5">
                <div class="col-md-4 mb-5">
                    <label class="form-label">{{ __('app.type') }}:</label>
                    <select name="parties[{{ $index }}][type]" aria-label="Select a Type"
                        data-placeholder="Select Type" class="form-select form-select-solid mb-5 mb-md-0 party-type"
                        data-control="select2" data-row-index="{{ $index }}"
                        wire:model="selectedPartyType.{{ $index }}.type">
                        <option value=""></option>
                        @foreach ($partyTypes as $id => $type)
                            <option wire:key="{{ $loop->index . time() }}" value="{{ $id }}">
                                {{ __('app.' . $type['text']) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8 mb-5" wire:key="{{ $loop->index . '_name' . time() }}">
                    <label class="form-label">{{ __('app.name') }}:</label>
                    <input name="parties[{{ $index }}][name]"
                        wire:model.lazy="selectedPartyType.{{ $index }}.name" type="text"
                        class="form-control form-control-solid mb-2 mb-md-0" placeholder="Enter contact name" />
                </div>
                <div class="col-md-4" wire:key="{{ $loop->index . '_phone' . time() }}">
                    <label class="form-label">{{ __('app.phone') }}:</label>
                    <input name="parties[{{ $index }}][phone]"
                        wire:model.lazy="selectedPartyType.{{ $index }}.phone" type="text"
                        class="form-control form-control-solid mb-2 mb-md-0" placeholder="Enter contact number" />
                </div>
                <div class="col-md-4" wire:key="{{ $loop->index . '_email' . time() }}">
                    <label class="form-label">{{ __('app.email') }}:</label>
                    <input name="parties[{{ $index }}][email]"
                        wire:model.lazy="selectedPartyType.{{ $index }}.email" type="text"
                        class="form-control form-control-solid mb-2 mb-md-0"
                        placeholder="Enter contact email address" />
                </div>
                @if (!$loop->first)
                    <div class="col-md-4">
                        <a href="javascript:;" wire:click="removePartyFormItem({{ $index }})"
                            class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                            <i class="la la-trash-o fs-3"></i>Delete
                        </a>
                    </div>
                @endif
                @if ($partiesFormItems[$index]['showAddSubPartyButton'])
                    <div class="col-md-12">
                        @if (count($partiesFormItems[$index]['subPartyFormItems']) > 0)
                            <a href="javascript:;" wire:click="removeAllSubPartyItem({{ $index }})"
                                class="btn btn-sm btn-link mt-3 text-danger">
                                {{ __('app.party.remove_party') }}
                            </a>
                        @else
                            <a href="javascript:;" wire:click="addSubPartyItem({{ $index }})"
                                class="btn btn-sm btn-link mt-3">
                                {{ __('app.party.add_party') }}
                            </a>
                        @endif
                        <div class="mt-5 mb-10 ms-10">
                            @foreach ($partyItem['subPartyFormItems'] as $subIndex => $subPartyitem)
                                @if ($loop->first)
                                    <label class="form-label">{{ __('app.party-name') }}:</label>
                                @endif
                                <div wire:key="{{ $loop->index }}-{{ time() }}" class="row mb-3">
                                    <div class="col-12">
                                        <div class="input-group flex-nowrap">
                                            <div class="overflow-hidden flex-grow-1">
                                                <select
                                                    name="parties[{{ $index }}][sub-party][{{ $subIndex }}]"
                                                    aria-label="Select a Type" data-placeholder="Select Type"
                                                    class="form-select sub-party-name form-select-solid rounded-end-0 border-end"
                                                    data-row-index="{{ $subIndex }}"
                                                    data-row-parent-index="{{ $index }}" data-control="select2"
                                                    wire:model="selectedSubPartyName.{{ $index }}.{{ $subIndex }}">
                                                    <option value=""></option>
                                                    @foreach ($partyTypes as $id => $type)
                                                        <option value="{{ $id }}">
                                                            {{ $type['text'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <a href="javascript:;"
                                                class="rounded-start-0 input-group-text border border-secondary btn btn-icon btn-light-danger"
                                                wire:click="removeSubPartyItem({{ $index }},{{ $subIndex }})"
                                                type="button">
                                                <i class="la la-trash-o fs-3"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @if ($loop->last)
                                    <a href="javascript:;" class="btn btn-sm btn-light-primary"
                                        wire:click="addSubPartyItem({{ $index }})" type="button">
                                        <i class="la la-plus"></i> {{ __('app.party.add_party') }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            @if (!$loop->last)
                <div class="separator separator-dashed my-5"></div>
            @endif
        @endforeach
        <!--end::Form group-->
        <div class="separator separator-dashed my-5"></div>
        <div class="form-group">
            <a href="javascript:;" class="btn btn-sm btn-block btn-warning col-12" wire:click="addPartyFormItem">
                <i class="la la-plus"></i>Add
            </a>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener("livewire:load", () => {

            initSelection();

            Livewire.hook('message.processed', (message, component) => {
                initSelect()
                initSelection();
            })

            function initSelect() {
                $('#matter_create_parties_repeater').find('[data-control="select2"]').select2({})
            }

            function initSelection() {
                $(".party-type").on('change', function(e) {
                    //validator.revalidateField($(this).attr('name'));
                    Livewire.emit('selectPartyType', $(this).data('row-index'), $(this).select2("val"));
                })
                $(".sub-party-name").on('change', function(e) {
                    //validator.revalidateField($(this).attr('name'));
                    Livewire.emit('selectSubPartyName', $(this).data('row-parent-index'), $(this).data(
                        'row-index'), $(this).select2("val"));
                })
            }
        })
    </script>
@endpush
