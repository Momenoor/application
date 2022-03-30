<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header mt-6">
        <!--begin::Card title-->
        <div class="card-title flex-column">
            <h3 class="fw-bolder mb-1">{{ __('app.claims') }}</h3>
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">{{ __('app.collect') }}</a>
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body p-9 pt-3">
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle gs-0 gy-4 my-0">
                <!--begin::Table head-->
                <thead>
                    <tr class="fs-7 fw-bolder text-gray-500">
                        <th class="p-0 min-w-100px d-block pt-3">{{ __('app.date') }}</th>
                        <th class="min-w-140px text-center pt-3">{{ __('app.type') }}</th>
                        <th class="min-w-140px text-center pt-3">{{ __('app.recurring') }}</th>
                        <th class="pe-0 text-center min-w-120px pt-3">{{ __('app.amount') }}</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                    @foreach ($matter->claims as $claim)
                        <tr>
                            <td>
                                <a href="#"
                                    class="text-gray-800 fw-bolder text-hover-primary mb-1">{{ $claim->date->format('Y-m-d') }}</a>
                            </td>
                            <td class="text-center">
                                <span
                                    class="badge badge-light-{{$claim->type_color}} fw-bolder">{{ __('app.' . $claim->type) }}</span>
                            </td>
                            <td class="text-center">
                                <span
                                    class="badge badge-light-{{$claim->recurring_color}} fw-bolder">{{ __('app.' . $claim->recurring) }}</span>
                            </td>
                            <td class="text-center">
                                <span class="text-gray-800 fw-bolder d-block">{{ $claim->claim_amount }} AED</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-top">
                        <th class="text-center text-gray-800 fw-bolder fs-6" colspan="3">{{__('app.total')}}</th>
                        <th class="text-center text-gray-800 fw-bolder d-block fs-6">{{$matter->claims_sum_amount}} AED</th>
                    </tr>
                    <tr class="border-top">
                        <th class="text-center text-gray-800 fw-bolder fs-6" colspan="3">{{__('app.collected')}}</th>
                        <th class="text-center text-success fw-bolder d-block fs-6">{{$matter->cash_sum_amount}} AED</th>
                    </tr>
                </tfoot>
                <!--end::Table body-->
            </table>
        </div>
    </div>
</div>
