@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                {{ __('app.create-vacation') }}
            </div>
        </div>
        <form action="{{ route('vacation.store',['type'=>'annual_leave']) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row p-10">
                    <div class="col-8">
                        <div class="row">
                            <div class="mb-10">
                                <label class="form-label">{{ __('app.request_by') }}</label>
                                <select data-control="select2"
                                    class="form-select form-select-solid @error('request_by') is-invalid @enderror"
                                    name="request_by" data-control="daterangepicker"
                                    data-placeholder="{{ __('app.select') . ' ' . __('app.name') }}" id="requestBy">
                                    <option></option>
                                    @foreach ($data['users'] as $user)
                                        <option @if (old('request_by') == $user->id) selected @endif
                                            value="{{ $user->id }}">{{ $user->display_name }}</option>
                                    @endforeach
                                </select>
                                @error('request_by')
                                    <div class=" invalid-feedback fv-plugins-message-container">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-10">
                                <label class="form-label">{{ __('app.vacation-start-end-date') }}</label>
                                <input class="form-control form-control-solid @error('start_end_date') is-invalid @enderror"
                                    name="start_end_date" data-control="daterangepicker"
                                    placeholder="{{ __('app.Pick date rage') }}" id="startEndDate"
                                    value="{{ old('start_end_date') }}" />
                                @error('start_end_date')
                                    <div class=" invalid-feedback fv-plugins-message-container">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-10">
                                <label class="form-label">{{ __('app.description') }}</label>
                                <textarea class="form-control form-control-solid @error('title') is-invalid @enderror" name="title"
                                    placeholder="{{ __('app.enter') . ' ' . __('app.description') }}"
                                    id="title">{{ old('title')??__('app.annual-leave') }}</textarea>
                                @error('title')
                                    <div class=" invalid-feedback fv-plugins-message-container">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @include('common.card-footer')
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        $('input[data-control="daterangepicker"]').daterangepicker({
            locale: {
                format: "DD-MM-YYYY"
            }
        });
    </script>
@endpush
