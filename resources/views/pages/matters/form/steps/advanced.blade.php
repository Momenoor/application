<div class="w-100">
    <!--begin::Heading-->
    <div class="">
        <!--begin::Title-->
        <h2 class="fw-bolder text-dark">{{ __('app.advanced-data') }}</h2>
        <!--end::Title-->
        <!--begin::Notice-->
        <div class="text-muted fw-bold fs-6">If you need more info, please check out
            <a href="#" class="link-primary fw-bolder">Help Page</a>.
        </div>
        <!--end::Notice-->
    </div>
    <div class="separator separator-dashed my-10"></div>
    <div class="fv-row">
        <!--begin::Row-->
        <div class="row gx-10 mb-5">
            <!--begin::Col-->
            <div class="col-lg-12">

                @livewire('matter-create-financial',['marketers' => $marketers])
            </div>
        </div>
        <div class="separator separator-dashed my-10"></div>

    </div>
    <!--end::Heading-->
</div>
