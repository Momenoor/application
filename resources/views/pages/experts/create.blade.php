@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title"></div>
        </div>
        <div class="card-body col-lg-8 col-sm-12 col-md-10">
            <form action="{{ route('expert.store') }}" method="POST">
                @csrf
                @include('pages.experts.create-expert-form')
                <div class="d-flex flex-stack w-lg-50">
                    <!--begin::Label-->
                    <div class="me-5">
                        <label class="fs-6 fw-bold form-label">{{ __('app.create-user?') }}</label>
                    </div>
                    <!--end::Label-->
                    <!--begin::Switch-->
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" name="create_user" type="checkbox" value="1" />
                    </label>
                    <!--end::Switch-->
                </div>
        </div>
        <div class="card-footer">
            <a href="{{route('expert.index')}}" class="btn btn-light" data-bs-dismiss="modal">{{ __('app.cancel') }}</a>
            <button type="submit" class="btn btn-primary">{{ __('app.save') }}</button>
        </div>
        </form>
    </div>
@endsection
