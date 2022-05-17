@csrf
<div class="modal-header">
    <h5 class="modal-title">{{ __('app.add_expert') }}</h5>

    <!--begin::Close-->
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <span class="svg-icon svg-icon-2x"></span>
    </div>
    <!--end::Close-->
</div>

<div class="modal-body">
    @include('pages.experts.create-expert-form')
</div>
