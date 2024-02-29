@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">{{ __('app.commissions') }}</div>
        </div>
        <div class="card-body align-center">
            <div class="row">
                <div class="col-lg-8 col-md-10 col-sm-12 ms-auto me-auto">
                    <form action="{{ route('commissions.store') }}" method="POST">
                        @csrf
                        <div class="mb-10 row">
                            <div class="col-6">
                                <label class="form-label fw-bolder" for="startDate">
                                    {{ __('app.reported_date') }}
                                </label>
                                <input id="startDate" name="start_date" data-control="flatpickr"
                                       placeholder="{{ __('app.please_select_start_date') }}"
                                       class="@error('start_date') is-invalid @enderror form-control form-control-solid"/>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bolder" for="endDate">
                                    {{ __('app.reported_date') }}
                                </label>
                                <input id="endDate" name="end_date" data-control="flatpickr"
                                       placeholder="{{ __('app.please_select_end_date') }}"
                                       class="@error('start_date') is-invalid @enderror form-control form-control-solid"/>
                            </div>
                        </div>
                        <div class="mb-10">
                            <div class="mb-1">
                                <label for="category" class="form-label fw-bolder">{{ __('app.category') }}</label>
                            </div>
                            <!--begin::Radio group-->
                            <div class="btn-group w-100 w-lg-50" data-kt-buttons="true"
                                 data-kt-buttons-target="[data-kt-button]">
                                <!--begin::Radio-->
                                <label
                                    class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success"
                                    data-kt-button="true">
                                    <!--begin::Input-->
                                    <input class="btn-check" type="radio" name="category" value="office"/>
                                    <!--end::Input-->
                                    {{ __('app.office') }}
                                </label>
                                <!--end::Radio-->

                                <!--begin::Radio-->
                                <label
                                    class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success"
                                    data-kt-button="true">
                                    <!--begin::Input-->
                                    <input class="btn-check" type="radio" name="category" value="private"/>
                                    <!--end::Input-->
                                    {{ __('app.private') }}
                                </label>
                                <!--end::Radio-->

                                <!--begin::Radio-->
                                <label
                                    class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-primary active"
                                    data-kt-button="true">
                                    <!--begin::Input-->
                                    <input class="btn-check" type="radio" checked="checked" name="category"
                                           value="all"/>
                                    <!--end::Input-->
                                    {{ __('app.all') }}
                                </label>
                                <!--end::Radio-->
                            </div>
                            <!--end::Radio group-->
                        </div>
                        <div class="pt-15">
                            <button type="reset" class="btn btn-light me-3"
                                    data-kt-permissions-modal-action="cancel">{{ __('app.reset') }}</button>
                            <button type="submit" class="btn btn-success">
                                <span class="indicator-label">{{ __('app.view') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @isset($result)
                <table class="table table-striped table-row-dashed table-row-gray-200 align-middle gs-0 gy-4 no-footer">
                    <thead>
                    <tr>
                        <th>{{ __('app.no') }}</th>
                        <th>{{ __('app.year') }}</th>
                        <th>{{ __('app.expert') }}</th>
                        <th>{{ __('app.court') }}</th>
                        <th>{{ __('app.type') }}</th>
                        <th>{{ __('app.assistant') }}</th>
                        <th>{{ __('app.plaintiff') }}</th>
                        <th>{{ __('app.defendant') }}</th>
                        <th>{{ __('app.status') }}</th>
                        <th>{{ __('app.received_date') }}</th>
                        <th>{{ __('app.reported_date') }}</th>
                        <th>{{ __('app.submitted_date') }}</th>
                        <th>{{ __('app.claim_status') }}</th>
                        <th>{{ __('app.claim_amount') }}</th>
                        <th>{{ __('app.claim_dues') }}</th>
                        <th>{{ __('app.claim_collected') }}</th>
                    </tr>
                    </thead>
                    @foreach ($result as $matter)
                        <tr>
                            <td>{{ $matter->number }}</td>
                            <td>{{ $matter->year }}</td>
                            <td>{{ optional($matter->expert)->name }}</td>
                            <td>{{ optional($matter->court)->name }}</td>
                            <td>{{ optional($matter->type)->name }}</td>
                            <td>{{ optional($matter->assistant)->name }}</td>
                            <td>{{ optional($matter->plaintiff)->name }}</td>
                            <td>{{ optional($matter->defendant)->name }}</td>
                            <td>{{ __('app.' . $matter->status) }}</td>
                            <td>{{ optional($matter->received_date)->format('Y-m-d') }}</td>
                            <td>{{ optional($matter->reported_date)->format('Y-m-d') }}</td>
                            <td>{{ optional($matter->submitted_date)->format('Y-m-d') }}</td>
                            <td>{{ $matter->claim_status}}</td>
                            <td>{{ $matter->claims_sum_amount }}</td>
                            <td>{{ $matter->dueAmount() }}</td>
                            <td>{{ $matter->cash_sum_amount }}</td>
                        </tr>
                    @endforeach
                </table>
            @endisset
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('[data-control="flatpickr"]').flatpickr({
            altInput: !0,
            altFormat: "d F, Y",
            dateFormat: "Y-m-d"
        });
    </script>
@endpush
