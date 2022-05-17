@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title"></div>
        </div>
        <div class="card-body col-lg-8 col-sm-12 col-md-10">
            <form action="{{ route('expert.update', $expert) }}" method="POST">
                @csrf
                @method('PATCH')
                @include('pages.experts.create-expert-form')
                <div class="d-flex flex-stack w-lg-50">
                    <!--begin::Label-->
                    <div class="me-5">
                        <label class="fs-6 fw-bold form-label">{{ __('app.active') }}</label>
                    </div>
                    <!--end::Label-->
                    <!--begin::Switch-->
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" name="newexpert[active]" type="checkbox" value="active"
                            @if (($expert->active ?? old('newexpert.active')) == 'active') checked="checked" @endif />
                    </label>
                    <!--end::Switch-->
                </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('expert.index') }}" class="btn btn-light">{{ __('app.cancel') }}</a>
            <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
        </div>
        </form>
    </div>
@endsection
