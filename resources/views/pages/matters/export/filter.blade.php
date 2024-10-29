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
                                    <label for="startDate"
                                           class="form-label fw-bolder">{{ __('app.start_date') }}</label>
                                    <div class="ms-4 form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input" name="start_date_type" type="radio"
                                               value="received_date" id="received_date"
                                            {{ old('start_date_type', request()->input('start_date_type', 'received_date')) == 'received_date' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="received_date">
                                            {{ __('app.received_date') }}
                                        </label>
                                    </div>
                                    <div class="ms-4 form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input" name="start_date_type" type="radio"
                                               value="reported_date" id="reported_date"
                                            {{ old('start_date_type', request()->input('start_date_type')) == 'reported_date' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="reported_date">
                                            {{ __('app.reported_date') }}
                                        </label>
                                    </div>
                                </div>
                                <input id="startDate" name="start_date" data-control="flatpickr"
                                       placeholder="{{ __('app.please_select_start_date') }}"
                                       value="{{ old('start_date', request()->input('start_date')) }}"
                                       class="@error('start_date') is-invalid @enderror form-control form-control-solid"/>
                            </div>
                            <div class="col-6">
                                <div class="d-flex mb-3 h-20px">
                                    <label for="endDate" class="form-label fw-bolder">{{ __('app.end_date') }}</label>
                                    <div class="ms-4 form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input" name="end_date_type" type="radio"
                                               value="received_date" id="end_received_date"
                                            {{ old('end_date_type', request()->input('end_date_type', 'received_date')) == 'received_date' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="end_received_date">
                                            {{ __('app.received_date') }}
                                        </label>
                                    </div>
                                    <div class="ms-4 form-check form-check-custom form-check-solid form-check-sm">
                                        <input class="form-check-input" name="end_date_type" type="radio"
                                               value="reported_date" id="end_reported_date"
                                            {{ old('end_date_type', request()->input('end_date_type')) == 'reported_date' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="end_reported_date">
                                            {{ __('app.reported_date') }}
                                        </label>
                                    </div>
                                </div>
                                <input id="endDate" name="end_date" data-control="flatpickr"
                                       placeholder="{{ __('app.please_select_end_date') }}"
                                       value="{{ old('end_date', request()->input('end_date')) }}"
                                       class="@error('end_date') is-invalid @enderror form-control form-control-solid"/>
                            </div>
                        </div>
                        <div class="mb-10 row">
                            <div class="col-8">
                                <label for="court" class="form-label fw-bolder">{{ __('app.court') }}</label>
                                <select id="court" name="court" aria-label="{{ __('app.please_select_a_court') }}"
                                        data-control="select2" data-placeholder="{{ __('app.please_select_a_court') }}"
                                        class="@error('court') is-invalid @enderror form-select form-select-solid">
                                    <option value=""></option>
                                    <option
                                        value="all" {{ old('court', request()->input('court')) == 'all' ? 'selected' : '' }}>{{ __('app.all') }}</option>
                                    @foreach ($courts as $id => $court)
                                        <option
                                            value="{{ $id }}" {{ old('court', request()->input('court')) == $id ? 'selected' : '' }}>
                                            {{ $court }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="type" class="form-label fw-bolder">{{ __('app.type') }}</label>
                                <select id="type" name="type" aria-label="{{ __('app.please_select_a_type') }}"
                                        data-control="select2" data-placeholder="{{ __('app.please_select_a_type') }}"
                                        class="@error('type') is-invalid @enderror form-select form-select-solid">
                                    <option value=""></option>
                                    <option
                                        value="all" {{ old('type', request()->input('type')) == 'all' ? 'selected' : '' }}>{{ __('app.all') }}</option>
                                    @foreach ($types as $id => $type)
                                        <option
                                            value="{{ $id }}" {{ old('type', request()->input('type')) == $id ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="expert" class="form-label fw-bolder">{{ __('app.expert') }}</label>
                            <select id="expert" name="expert" aria-label="{{ __('app.please_select_an_expert') }}"
                                    data-control="select2" data-placeholder="{{ __('app.please_select_an_expert') }}"
                                    class="@error('expert') is-invalid @enderror form-select form-select-solid">
                                <option value=""></option>
                                <option
                                    value="all" {{ old('expert', request()->input('expert')) == 'all' ? 'selected' : '' }}>{{ __('app.all') }}</option>
                                @foreach ($experts as $id => $expert)
                                    <option
                                        value="{{ $id }}" {{ old('expert', request()->input('expert')) == $id ? 'selected' : '' }}>
                                        {{ $expert }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="assistant" class="form-label fw-bolder">{{ __('app.assistant') }}</label>
                            <select id="assistant" name="assistant"
                                    aria-label="{{ __('app.please_select_an_assistant') }}"
                                    data-control="select2" data-placeholder="{{ __('app.please_select_an_assistant') }}"
                                    class="@error('assistant') is-invalid @enderror form-select form-select-solid">
                                <option value=""></option>
                                <option
                                    value="all" {{ old('assistant', request()->input('assistant')) == 'all' ? 'selected' : '' }}>{{ __('app.all') }}</option>
                                @foreach ($assistants as $id => $assistant)
                                    <option
                                        value="{{ $id }}" {{ old('assistant', request()->input('assistant')) == $id ? 'selected' : '' }}>
                                        {{ $assistant }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="" class="form-label fw-bolder">{{ __('app.claims_collection_status') }}</label>
                            <div class="d-flex">
                                @foreach ($claimsStatus as $status)
                                    <div class="form-check form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" type="checkbox" name="claimsCollectionStatus[]"
                                               value="{{ $status }}" id="{{ $status }}"
                                            {{ in_array($status, old('claimsCollectionStatus', request()->input('claimsCollectionStatus', []))) ? 'checked' : '' }} />
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
                                    <input class="form-check-input" type="checkbox" name="matterStatus[]"
                                           value="current"
                                           id="current" {{ in_array('current', old('matterStatus', request()->input('matterStatus', []))) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="current">{{ __('app.current') }}</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5">
                                    <input class="form-check-input" type="checkbox" name="matterStatus[]"
                                           value="reported"
                                           id="reported" {{ in_array('reported', old('matterStatus', request()->input('matterStatus', []))) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="reported">{{ __('app.reported') }}</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5">
                                    <input class="form-check-input" type="checkbox" name="matterStatus[]"
                                           value="submitted"
                                           id="submitted" {{ in_array('submitted', old('matterStatus', request()->input('matterStatus', []))) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="submitted">{{ __('app.submitted') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-10">
                            <div class="mb-1">
                                <label for="category" class="form-label fw-bolder">{{ __('app.category') }}</label>
                            </div>
                            <div class="btn-group w-100 w-lg-50" data-kt-buttons="true"
                                 data-kt-buttons-target="[data-kt-button]">
                                <label
                                    class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success"
                                    data-kt-button="true">
                                    <input class="btn-check" type="radio" name="category" value="office"
                                        {{ old('category', request()->input('category', 'all')) == 'office' ? 'checked' : '' }} />
                                    {{ __('app.office') }}
                                </label>
                                <label
                                    class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success"
                                    data-kt-button="true">
                                    <input class="btn-check" type="radio" name="category" value="private"
                                        {{ old('category', request()->input('category')) == 'private' ? 'checked' : '' }} />
                                    {{ __('app.private') }}
                                </label>
                                <label
                                    class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-primary active"
                                    data-kt-button="true">
                                    <input class="btn-check" type="radio" name="category" value="all"
                                        {{ old('category', request()->input('category', 'all')) == 'all' ? 'checked' : '' }} />
                                    {{ __('app.all') }}
                                </label>
                            </div>
                        </div>
                        <div class="pt-15">
                            <button type="reset" class="btn btn-light me-3"
                                    data-kt-permissions-modal-action="cancel">{{ __('app.reset') }}</button>
                            <button type="submit" name="action" value="export" class="btn btn-success me-3">
                                <span class="indicator-label">{{ __('app.export') }}</span>
                            </button>
                            <button type="submit" name="action" value="view" class="btn btn-primary me-3">
                                <span class="indicator-label">{{ __('app.view') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @isset($matters)
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">{{ __('app.matter_list') }}</div>
                    </div>
                    <div class="card-body align-center">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 ms-auto me-auto">
                                <table
                                    class="table table-striped table-row-dashed table-row-gray-200 align-middle gs-0 gy-4 no-footer">
                                    <thead>
                                    <tr>
                                        <th class="ps-3">{{ __('app.no') }}</th>
                                        <th>{{ __('app.year') }}</th>
                                        <th>{{ __('app.expert') }}</th>
                                        <th>{{ __('app.court') }}</th>
                                        <th>{{ __('app.type') }}</th>
                                        <th>{{ __('app.assistant') }}</th>
                                        <th>{{ __('app.status') }}</th>
                                        <th>{{ __('app.last_action_date') }}</th>
                                        <th>{{ __('app.reported_date') }}</th>
                                        <th>{{ __('app.claim_amount') }}</th>
                                        <th>{{ __('app.commission_period') }}</th>
                                        <th>{{ __('app.commission_percent') }}</th>
                                        <th>{{ __('app.commission_amount') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach ($matters as $matter)
                                        <tr>
                                            <td class="ps-3">{{ $matter->number }}</td>
                                            <td>{{ $matter->year }}</td>
                                            <td>{{ optional($matter->expert)->name }}</td>
                                            <td>{{ optional($matter->court)->name }}</td>
                                            <td>{{ optional($matter->type)->name }}</td>
                                            <td>{{ optional($matter->assistant)->name }}</td>
                                            <td>{{ __('app.' . $matter->status) }}</td>
                                            <td>{{ optional($matter->last_action_date)->format('Y-m-d') }}</td>
                                            <td>{{ optional($matter->reported_date)->format('Y-m-d') }}</td>
                                            <td>{{ $matter->claims_sum_amount }}</td>
                                            <td>{{ $matter->commission['period'] }}</td>
                                            <td>{{ $matter->commission['percent'] }}%</td>
                                            <td>{{ $matter->commission['amount'] }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
