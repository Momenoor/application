<div class="card mt-15">
    <div class="card-body">
        <div class="row gx-10 mb-5 mt-5 w-900px">
            <div class="col-lg-3">
                <h4 class="fw-bolder d-flex align-items-center text-dark">{{ __('app.financial') }}
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Billing is issued based on your selected account type"></i>
                </h4>
            </div>
            <!--begin::Col-->
            <div class="col-lg-9">
                <div class="row">
                    @include('pages.matters.form.partials.parties-marketer')
                </div>
                <div class="row">
                    @include('pages.matters.form.partials.parties-external-marketer')
                </div>
                <div class="row">
                    <div class="separator separator-dashed my-10"></div>
                </div>
                <div class="row">
                    @include('pages.matters.form.partials.claims')
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>
</div>
