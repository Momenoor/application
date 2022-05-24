@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">{{ __('app.matter_exporter') }}</div>
        </div>
        <div class="card-body align-center">
            <div class="row">
                <div class="col-lg-8 col-md-10 col-sm-12 ms-auto me-auto">
                    <form action="{{ route('matter.export') }}" method="POST">
                        @csrf
                        <div class="mb-10 row">
                            <div class="col-6">
                                <div class="d-flex mb-3 h-20px">
                                    <label for="startDate" class="form-label fw-bolder">{{ __('app.start_date') }}
                                    </label>
                                    <div class="ms-4 form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input" name="start_date_type" type="radio"
                                            checked="checked" value="received_date" id="received_date" />
                                        <label class="form-check-label" for="received_date">
                                            {{ __('app.received_date') }}
                                        </label>
                                    </div>
                                    <div class="ms-4 form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input" name="start_date_type" type="radio"
                                            value="reported_date" id="reported_date" />
                                        <label class="form-check-label" for="reported_date">
                                            {{ __('app.reported_date') }}
                                        </label>
                                    </div>
                                </div>
                                <input id="startDate" name="start_date" data-control="flatpickr"
                                    placeholder="{{ __('app.please_select_start_date') }}"
                                    class="@error('start_date') is-invalid @enderror form-control form-control-solid" />
                            </div>
                            <div class="col-6">
                                <div class="d-flex mb-3 h-20px">
                                    <label for="endDate" class="form-label fw-bolder">{{ __('app.end_date') }}
                                    </label>
                                    <div class="ms-4 form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input" name="end_date_type" type="radio" checked="checked"
                                            value="received_date" id="received_date" />
                                        <label class="form-check-label" for="received_date">
                                            {{ __('app.received_date') }}
                                        </label>
                                    </div>
                                    <div class="ms-4 form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input" name="end_date_type" type="radio"
                                            value="reported_date" id="reported_date" />
                                        <label class="form-check-label" for="reported_date">
                                            {{ __('app.reported_date') }}
                                        </label>
                                    </div>
                                </div>
                                <input id="endDate" name="end_date" data-control="flatpickr"
                                    placeholder="{{ __('app.please_select_end_date') }}"
                                    class="@error('start_date') is-invalid @enderror form-control form-control-solid" />
                            </div>
                        </div>
                        <div class="mb-10 row">
                            <div class="col-8">
                                <label for="court" class="form-label fw-bolder">{{ __('app.court') }}</label>
                                <select id="court" name="court" aria-label="{{ __('app.please_select_a_court') }}"
                                    data-control="select2" data-placeholder="{{ __('app.please_select_a_court') }}"
                                    class="@error('matter.court') is-invalid @enderror form-select form-select-solid">
                                    <option value=""></option>
                                    <option value="0">{{ __('app.all') }}</option>
                                    @foreach ($courts as $id => $court)
                                        <option value="{{ $id }}">
                                            {{ $court }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="type" class="form-label fw-bolder">{{ __('app.type') }}</label>
                                <select id="type" name="type" aria-label="{{ __('app.please_select_a_type') }}"
                                    data-control="select2" data-placeholder="{{ __('app.please_select_a_type') }}"
                                    class="@error('matter.type') is-invalid @enderror form-select form-select-solid">
                                    <option value=""></option>
                                    <option value="0">{{ __('app.all') }}</option>
                                    @foreach ($types as $id => $type)
                                        <option value="{{ $id }}">
                                            {{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="expert" class="form-label fw-bolder">{{ __('app.expert') }}</label>
                            <select id="expert" name="expert" aria-label="{{ __('app.please_select_an_expert') }}"
                                data-control="select2" data-placeholder="{{ __('app.please_select_an_expert') }}"
                                class="@error('matter.expert') is-invalid @enderror form-select form-select-solid">
                                <option value=""></option>
                                <option value="0">{{ __('app.all') }}</option>
                                @foreach ($experts as $id => $expert)
                                    <option value="{{ $id }}">
                                        {{ $expert }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="assistant" class="form-label fw-bolder">{{ __('app.assistant') }}</label>
                            <select id="assistant" name="assistant"
                                aria-label="{{ __('app.please_select_an_assistant') }}" data-control="select2"
                                data-placeholder="{{ __('app.please_select_an_assistant') }}"
                                class="@error('matter.assistant') is-invalid @enderror form-select form-select-solid">
                                <option value=""></option>
                                <option value="0">{{ __('app.all') }}</option>
                                @foreach ($assistants as $id => $assistant)
                                    <option value="{{ $id }}">
                                        {{ $assistant }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="" class="form-label fw-bolder">{{ __('app.claims_collection_status') }}</label>
                            <div class="d-flex">
                                @foreach ($claimsStatus as $status)
                                    <div class="form-check form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" type="checkbox" name="claimsCollectionStatus[]"
                                            value="{{ $status }}" id="{{ $status }}" checked />
                                        <label class="form-check-label" for="{{ $status }}">
                                            {{ __('app.' . $status) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="" class="form-label fw-bolder">{{ __('app.matter_status') }}</label>
                            <div class="d-flex">
                                <div class="form-check form-check-custom form-check-solid me-5">
                                    <input class="form-check-input" type="checkbox" name="matterStatus[]" value="current"
                                        id="current" />
                                    <label class="form-check-label" for="current">
                                        {{ __('app.current') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5">
                                    <input class="form-check-input" type="checkbox" name="matterStatus[]" value="reported"
                                        id="reported" />
                                    <label class="form-check-label" for="reported">
                                        {{ __('app.reported') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5">
                                    <input class="form-check-input" type="checkbox" name="matterStatus[]" value="submitted"
                                        id="submitted" checked />
                                    <label class="form-check-label" for="submitted">
                                        {{ __('app.submitted') }}
                                    </label>
                                </div>
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
                                    <input class="btn-check" type="radio" name="category" value="office" />
                                    <!--end::Input-->
                                    {{ __('app.office') }}
                                </label>
                                <!--end::Radio-->

                                <!--begin::Radio-->
                                <label
                                    class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success"
                                    data-kt-button="true">
                                    <!--begin::Input-->
                                    <input class="btn-check" type="radio" name="category" value="private" />
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
                                        value="all" />
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
                                <span class="indicator-label">{{ __('app.export') }}</span>
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
