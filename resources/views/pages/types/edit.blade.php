@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                {{ __('app.add_new_type') }}
            </div>
        </div>
        <form action="{{ route('type.update', $type) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row mb-10">
                    <div class="col-6">
                        <label class="form-label">
                            <span class="required">{{ __('app.name') }}</span>
                        </label>
                        <input name="name" class="form-control form-control-solid @error('name') is-invalid @enderror"
                            value="{{ $type->name ?? old('name') }}"
                            placeholder="{{ __('app.enter') . ' ' . __('app.name') }}" />
                        @error('name')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="d-flex flex-stack w-lg-50">
                            <!--begin::Label-->
                            <div class="me-5">
                                <label class="fs-6 fw-bold form-label">{{ __('app.is_active') }}</label>
                            </div>
                            <!--end::Label-->

                            <!--begin::Switch-->
                            <label class="form-check form-switch form-check-success form-check-custom form-check-solid">
                                <input class="form-check-input" name="active" type="checkbox" value="true"
                                    @if ($type->active == 'true') checked='true' @endif />
                            </label>
                            <!--end::Switch-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('type.index') }}" class="btn btn-light me-3">{{ __('app.cancel') }}</a>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">{{ __('app.save') }}</span>
                </button>
            </div>
        </form>
    </div>
@endsection
