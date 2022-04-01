<div>
    <div id="MatterCreateForm">
        @include('pages.matters.form.sections.basic-section')
        @include('pages.matters.form.sections.parties-section')
        @include('pages.matters.form.sections.financial-section')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9 offset-md-3">
                        <!--begin::Separator-->
                        <div class="separator mb-6"></div>
                        <!--end::Separator-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <button wire:click="reset" class="btn btn-light me-3">{{ __('app.cancel') }}</button>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button wire:click="save" class="btn btn-primary"> {{ __('app.save') }} </button>
                            <!--end::Button-->
                        </div>
                    </div>
                </div>
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
                    $('#MatterCreateForm').find('[data-control="select2"]').select2({});
                }

                function initSelection() {


                    $('[data-control="flatpickr"]').flatpickr({
                        altInput: !0,
                        altFormat: "d F, Y",
                        dateFormat: "Y-m-d"
                    });

                    $("select[name='type_id']").on('change', function(e) {

                        @this.set('matter.type_id', $(this).select2("val"));
                    });
                    $("select[name='court_id']").on('change', function(e) {

                        @this.set('matter.court_id', $(this).select2("val"));
                    });
                    $("select[name='expert_id']").on('change', function(e) {

                        @this.set('matter.expert_id', $(this).select2("val"));
                    });
                    $("select[name='committee']").on('change', function(e) {

                        @this.set('matter.committee', $(this).select2("val"));
                    });
                    $("select.party-type").on('change', function(e) {

                        @this.set('parties.' + $(this).data('row-index') + '.type', $(this).select2("val"));
                        Livewire.emit('showAddSubPartyButton', $(this).data('row-index'), $(this).select2(
                            "val"));
                    });
                    $("select.sub-party-name").on('change', function(e) {

                        @this.set('parties.' + $(this).data('row-parent-index') + '.subParties.' + $(this).data(
                            'row-index'), $(this).select2("val"));
                    });
                    $("select#marketer").on('change', function(e) {

                        @this.set('otherParties.marketer.id', $(this).select2("val"));
                        @this.set('otherParties.marketer.type', 'marketer');
                    });
                    $("select#externalMarketer").on('change', function(e) {

                        @this.set('otherParties.external_marketer.id', $(this).select2("val"));
                        @this.set('otherParties.external_marketer.type', 'external_marketer');
                    });
                    $("select#claimRecurring").on('change', function(e) {

                        @this.set('claim.recurring', $(this).select2("val"));
                    });
                    $("select#claimType").on('change', function(e) {

                        @this.set('claim.type', $(this).select2("val"));
                    });
                }
            })
        </script>
    @endpush
