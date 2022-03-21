<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header border-bottom">
        <!--begin::Card title-->
        <div class="card-title flex-column">
            <h3 class="fw-bolder mb-1">{{ __('app.parites') }}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card toolbar-->
    <!--begin::Card body-->
    <div class="card-body d-flex flex-column pt-3 mb-9">
        <!--begin::Item-->
        <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
            <!--begin::Table head-->
            <thead>
                <tr class="border-0">
                    <th class="p-0 w-50px"></th>
                    <th class="p-0 min-w-150px"></th>
                    <th class="p-0 min-w-140px"></th>
                    <th class="p-0 min-w-110px"></th>
                    <th class="p-0 min-w-50px"></th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody>
                @include(
                    'pages.matters.form.partials._show_parties_row',
                    ['items' => [$matter->expert]]
                )
                @include(
                    'pages.matters.form.partials._show_parties_row',
                    ['items' => $matter->experts]
                )
                @include(
                    'pages.matters.form.partials._show_parties_row',
                    ['items' => $matter->marketers]
                )
                @include(
                    'pages.matters.form.partials._show_parties_subparty_row',
                    ['items' => $parties]
                )
            </tbody>
            <!--end::Table body-->
        </table>
    </div>
    <!--end::Card body-->
</div>
