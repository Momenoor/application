<div>
    @if ($partyItem['showAddSubPartyButton'])
        <div class="col-md-12">
            @if (count($partyItem['subPartyFormItems']) > 0)
                <a href="javascript:;" wire:click="removeAllSubPartyItem({{ $parentIndex }})"
                    class="btn btn-sm btn-link mt-3 text-danger">
                    {{ __('app.party.remove_party') }}
                </a>

            @else
                <a href="javascript:;" wire:click="addSubPartyItem({{ $parentIndex }})"
                    class="btn btn-sm btn-link mt-3">
                    {{ __('app.party.add_party') }}
                </a>
            @endif
            <div class="mt-5 mb-10 ms-10">
                @foreach ($partyItem['subPartyFormItems'] as $subIndex => $subPartyitem)
                    @if ($loop->first)
                        <label class="form-label">{{ __('app.party-name') }}:</label>
                    @endif
                    <div wire:key="{{ $loop->index }} id="subPartyName" class="row mb-3">
                        <div class="col-12">
                            <div class="input-group flex-nowrap">
                                <div class="overflow-hidden flex-grow-1">
                                    <select name="parties[{{ $parentIndex }}][sub-party][{{ $subIndex }}]"
                                        aria-label="Select a Type" data-placeholder="Select Type"
                                        class="form-select sub-party-name form-select-solid rounded-end-0 border-end"
                                        data-row-index="{{ $subIndex }}" data-row-parent-index="{{ $parentIndex }}"
                                        data-control="select2">
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
                                    wire:click="removeSubPartyItem({{ $parentIndex }},{{ $subIndex }})"
                                    type="button">
                                    <i class="la la-trash-o fs-3"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($loop->last)
                        <a href="javascript:;" class="btn btn-sm btn-light-primary"
                            wire:click="addSubPartyItem({{ $parentIndex }})" type="button">
                            <i class="la la-plus"></i> {{ __('app.party.add_party') }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
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
                $('#subPartyName').find('.sub-party-name').select2()
            }

            function initSelection() {
                $(".sub-party-name").on('change', function(e) {
                    //validator.revalidateField($(this).attr('name'));
                    Livewire.emit('selectSubPartyName', $(this).data('row-index'), $(this).select2("val"));
                })
            }
        })
    </script>
@endpush
