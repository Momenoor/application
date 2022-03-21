<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0 cursor-pointer">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('app.matter-data') }}</h3>
        </div>
        <a href="{{ route('matter.edit', $matter) }}"
            class="btn btn-primary align-self-center">{{ 'app.edit' }}</a>

        <!--end::Card title-->
    </div>
    <div class="card-body pt-0">
        <div class="separator"></div>
        <div class="row mt-10">
            <div class="col-6">
                <div class="row mb-10">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('app.court') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ $matter->court->name }}</span>
                        @include('common.external-link', [
                            'href' => route('court.show', $matter->court),
                        ])
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-10">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('app.type') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ $matter->type->name }}</span>
                    </div>
                    <!--end::Col-->
                </div>
            </div>
            <div class="col-6">
                <div class="row mb-10">
                    <label class="col-4 fw-bold text-muted">{{ __('app.commissioning') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ $matter->commissioning }}</span>
                    </div>
                </div>
                <div class="row mb-10">
                    <label class="col-4 fw-bold text-muted">{{ __('app.status') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-8">
                        <span
                            class="fw-bolder fs-6 text-gray-800">{{ $matter->parent_id > 0 ? __('app.supplementary') : __('app.basic') }}</span>
                        @if ($matter->parent_id > 0)
                            @include('common.external-link', [
                                'href' => route('matter.show', $matter->parent_id),
                            ])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
