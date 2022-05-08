<div wire:ignore.self  class="modal fade" tabindex="-1" id="addSubPartyLivewireModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST">
                @include('pages.parties.add-advocate-form-inputs')
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light" data-bs-dismiss="modal">{{ __('app.cancel') }}</button>
                    <button type="button" wire:click="addNewSubparty" data-bs-dismiss="modal"
                        class="btn btn-primary">{{ __('app.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
