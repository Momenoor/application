<div wire:ignore.self class="modal fade" tabindex="-1" id="addExpertLivewireModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                @include('pages.experts.add-expert-form-inputs')
                <div class="modal-footer">
                    <button type="reset" wire:click="resetNewExpert" class="btn btn-light"
                        data-bs-dismiss="modal">{{ __('app.cancel') }}</button>
                    <button type="button" wire:click="addNewExpert"
                        class="btn btn-primary">{{ __('app.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')

<script>
    var modal = new bootstrap.Modal(document.getElementById('addExpertLivewireModal'));
    window.livewire.on('closeModal', () => {
        modal.hide();
    });
</script>

@endpush
