@extends('layouts.app')
@section('content')
    <div class="auth-bg card">
        <!--begin::Main-->
        <!--begin::Root-->
        <div class="card-body d-flex flex-column flex-root">
            <!--begin::Authentication - Error 500 -->
            <div class="d-flex flex-column flex-column-fluid">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-column-fluid text-center p-5">

                    <!--begin::Wrapper-->
                    <div class="pt-lg-10 mb-10">
                        <!--begin::Logo-->
                        <h1 class="fw-bolder fs-2qx text-gray-800 mb-10">{{ __('app.systeme-error') }}</h1>
                        <!--end::Logo-->
                        <!--begin::Message-->
                        <div class="fw-bold fs-3 text-muted mb-15">
                            {!! __($exception->getMessage() ?: 'app.request-page-not-found') !!}
                        </div>
                        <!--end::Message-->
                        <!--begin::Action-->
                        <div class="text-center">
                            <a href="{{ route('dashboard') }}"
                                class="btn btn-lg btn-primary fw-bolder">{{ __('app.go-to-homepage') }}</a>
                        </div>
                        <!--end::Action-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Illustration-->
                    <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                        style="background-image: url({{ asset('assets/media/illustrations/sketchy-1/17.png') }}"></div>
                    <!--end::Illustration-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Authentication - Error 500-->
        </div>
    </div>
@endsection
