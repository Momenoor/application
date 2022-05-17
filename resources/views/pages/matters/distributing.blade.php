@extends('layouts.app')
@section('content')
    <!--begin::Accordion-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">{{ __('app.matter-distributing') }}</div>
        </div>
        <div class="card-body">
            <div class="accordion" id="kt_accordion_1">
                <div class="p-2">
                    <table class="table table-sm mb-0">
                        <tr>
                            <td class="w-300px">{{ __('app.name') }}</td>
                            <td class="w-300px ps-15">{{ __('app.current_matters') }}</td>
                            <td class="w-300px ps-15">{{ __('app.matters_closed_during_month') }}</td>
                        </tr>
                    </table>
                </div>
                </button>
                @foreach ($assistants as $assistant)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="kt_accordion_1_header_{{ $assistant->id }}">
                            <button class="accordion-button py-2 collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#kt_accordion_1_body_{{ $assistant->id }}" aria-expanded="true"
                                aria-controls="kt_accordion_1_body_{{ $assistant->id }}">
                                <table class="table table-sm mb-0">
                                    <tr>
                                        <td class="w-300px">{{ $assistant->name }}</td>
                                        <td class="w-100px">{{ $assistant->current_count }}</td>
                                        <td class="w-200px">
                                            {{ format_amount($assistant->asAssistant->sum('claims_sum_amount_unformatted')) }}
                                        </td>
                                        <td class="w-100px">{{ $assistant->finished_count }}</td>
                                        <td class="w-200px">
                                            {{ format_amount($assistant->asAssistantAsFinished->sum('claims_sum_amount_unformatted')) }}
                                        </td>
                                    </tr>
                                </table>
                            </button>
                        </h2>
                        <div id="kt_accordion_1_body_{{ $assistant->id }}" class="accordion-collapse collapse "
                            aria-labelledby="kt_accordion_1_header_{{ $assistant->id }}"
                            data-bs-parent="#kt_accordion_1">
                            <div class="accordion-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                            <th>4</th>
                                            <th>5</th>
                                            <th>6</th>
                                            <th>7</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--end::Accordion-->
@endsection
