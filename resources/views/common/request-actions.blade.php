<div class="text-end me-5">
    @if($model->attachments->count() >0)
        <a class="btn btn-primary btn-icon btn-sm" href="{{asset($model->attachments->first()->path) }}" download>
            <i class="fas  fa-download"></i>
            </span>
            <!--end::Svg Icon--></a>
    @endif
    @empty($model->approved_at)
        <a class="btn btn-success btn-icon btn-sm ms-2 btn-text-white"
           data-bs-toggle="modal"
           data-bs-target="#approveRequestModal"><i class="fas fa-check"></i></a>
        <a class="btn btn-danger btn-icon btn-sm ms-2 btn-text-white"
           data-bs-toggle="modal"
           data-bs-target="#rejectRequestModal"><i class="fas fa-ban"></i></a>
</div>
@include('pages.matters.request.approve-request-modal')
@include('pages.matters.request.reject-request-modal')
@endempty

