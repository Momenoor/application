@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                {{ __('app.remove_duplicated') }}
            </div>
        </div>
        <form action="{{ route('tools.remove-duplicated') }}" method="POST">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">{{ __('app.select_table') }}</label>
                        <select name="tableName" data-control="select2" data-placeholder="{{ __('app.select_table') }}"
                            class="form-select-solid form-select">
                            <option></option>
                            @foreach ($tables as $table)
                                <option value="{{ $table }}">{{ $table }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="reset" class="btn btn-light">{{ __('app.cancel') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('app.remove') }}</button>
            </div>
        </form>
    </div>
@endsection
