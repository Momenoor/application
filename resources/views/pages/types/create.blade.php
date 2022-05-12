@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                {{ __('app.add_new_type') }}
            </div>
        </div>
        <form action="{{ route('type.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">
                            <span class="required">{{ __('app.name') }}</span>
                        </label>
                        <input name="name" class="form-control form-control-solid @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" placeholder="{{ __('app.enter') . ' ' . __('app.name') }}" />
                        @error('name')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('type.index')}}" class="btn btn-light me-3">{{ __('app.cancel') }}</a>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">{{ __('app.save') }}</span>
                </button>
            </div>
        </form>
    </div>
@endsection
