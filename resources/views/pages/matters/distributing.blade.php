@extends('layouts.app')
@section('content')
    <!--begin::Accordion-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">{{ __('app.matter-distributing') }}</div>
        </div>
        <div class="card-body">
            <div class="accordion p-5" id="kt_accordion_1">
                <div class="accordion-item p-2">
                    <table class="table fw-bolder table-sm mb-0">
                        <tr>
                            <td class="w-200px px-5 text-center">{{ __('app.name') }}</td>
                            <td class="w-200px px-5 text-center">{{ __('app.current_matters') }}</td>
                            <td class="w-200px px-5 text-center">{{ __('app.matters_closed_during_month') }}</td>
                            <td class="w-200px px-5 text-center">
                                {{ __('app.matters_last_activity_month') . ' ' . $last_activity_start_date }}</td>
                        </tr>
                    </table>
                </div>
                </button>
                @foreach ($assistants as $assistant)
                    <div class="accordion-item ">
                        <h2 class="accordion-header" id="kt_accordion_1_header_{{ $assistant->id }}">
                            <button class="accordion-button py-2 collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#kt_accordion_1_body_{{ $assistant->id }}" aria-expanded="true"
                                aria-controls="kt_accordion_1_body_{{ $assistant->id }}">
                                <table class="table table-sm mb-0">
                                    <tr class="align-middle">
                                        <td class="w-200px border-right-1">{{ $assistant->name }}
                                            <div class="progress mt-3 me-5">
                                                <div class="progress-bar bg-warning bg-gradient" role="progressbar" style="width: {{($assistant->current_count/$countCurrent) * 100}}%"
                                                    aria-valuenow="{{($assistant->current_count/$countCurrent) * 100}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="w-75px text-primary ps-5">{{ $assistant->current_count }}</td>
                                        <td class="w-125px border-right-1">
                                            {{ format_amount($assistant->asAssistant->sum('claims_sum_amount_unformatted')) }}
                                        </td>
                                        <td class="w-75px text-success ps-5">{{ $assistant->finished_count }}</td>
                                        <td class="w-125px border-right-1">
                                            {{ format_amount($assistant->asAssistantAsFinished->sum('claims_sum_amount_unformatted')) }}
                                        </td>
                                        <td class="w-75px text-success ps-5">{{ $assistant->last_activity_count }}</td>
                                        <td class="w-125px ">
                                            {{ format_amount($assistant->asAssistantLastActivityMonth->sum('claims_sum_amount_unformatted')) }}
                                        </td>
                                    </tr>
                                </table>
                            </button>
                        </h2>
                        <div id="kt_accordion_1_body_{{ $assistant->id }}" class="accordion-collapse collapse "
                            aria-labelledby="kt_accordion_1_header_{{ $assistant->id }}"
                            data-bs-parent="#kt_accordion_1">
                            <div class="accordion-body table-responsive">
                                <div class="py-5">
                                    <div class="d-flex align-items-center text-primary me-15 mb-5">
                                        <span class="bullet bg-primary h-5px w-15px me-5"></span>
                                        {{ __('app.office') }}
                                    </div>
                                    <table class="table table-sm table table-row-dashed table-row-gray-300">
                                        <thead>
                                            <tr class="fw-bolder text-gray-800">
                                                <th>{{ __('app.number') . '/' . __('app.year') }}</th>
                                                <th>{{ __('app.court') }}</th>
                                                <th>{{ __('app.type') }}</th>
                                                <th>{{ __('app.claims') }}</th>
                                                <th>{{ __('app.commissioning') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($assistant->asAssistant as $matter)
                                                <tr class="">
                                                    <td>{{ $matter->number . '/' . $matter->year }}</td>
                                                    <td>{{ $matter->court->name }}</td>
                                                    <td>{{ $matter->type->name }}</td>
                                                    <td>{{ format_amount($matter->claims->sum('amount')) }}</td>
                                                    <td>{{ __('app.' . $matter->commissioning) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr class="fw-bolder">
                                                <td colspan="3" class="text-center">{{ __('app.total') }}</td>
                                                <td>
                                                    {{ format_amount($assistant->asAssistant->sum('claims_sum_amount_unformatted')) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @if (count($assistant->matters) > 0)
                                    <div class="py-5">
                                        <div class="d-flex align-items-center text-primary me-15 mb-5">
                                            <span class="bullet bg-primary h-5px w-15px me-5"></span>
                                            {{ __('app.private') }}
                                        </div>
                                        <table class="table table-sm table table-row-dashed table-row-gray-300">
                                            <thead>
                                                <tr class="fw-bolder text-gray-800">
                                                    <th>{{ __('app.number') . '/' . __('app.year') }}</th>
                                                    <th>{{ __('app.court') }}</th>
                                                    <th>{{ __('app.type') }}</th>
                                                    <th>{{ __('app.claims') }}</th>
                                                    <th>{{ __('app.commissioning') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($assistant->matters as $matter)
                                                    <tr class="">
                                                        <td>{{ $matter->number . '/' . $matter->year }}</td>
                                                        <td>{{ $matter->court->name }}</td>
                                                        <td>{{ $matter->type->name }}</td>
                                                        <td>{{ format_amount($matter->claims->sum('amount')) }}</td>
                                                        <td>{{ __('app.' . $matter->commissioning) }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr class="fw-bolder">
                                                    <td colspan="3" class="text-center">{{ __('app.total') }}</td>
                                                    <td>
                                                        {{ format_amount($assistant->matters->sum('claims_sum_amount_unformatted')) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--end::Accordion-->
@endsection
