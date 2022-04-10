@extends('layouts.app')
@section('content')
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
        @foreach ($roles as $role)
            <!--begin::Col-->
            <div class="col-md-4">
                <!--begin::Card-->
                <div class="card card-flush h-md-100">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>{{ $role->name }}</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-1">
                        <!--begin::Users-->
                        <div class="fw-bolder text-gray-600 mb-5">{{ __('app.total_users_with_this_role') }}:
                            {{ $role->users_count > 0 ?: __('app.none') }}</div>
                        <!--end::Users-->
                        <!--begin::Permissions-->
                        <div class="d-flex flex-column text-gray-600">
                            @include('pages.users.roles._permissions', [
                                'permissions' => $role->permissions,
                            ])
                        </div>
                        <!--end::Permissions-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    <div class="card-footer flex-wrap pt-0">
                        <a href="{{ route('role.show', $role) }}"
                            class="btn btn-light btn-active-primary my-1 me-2">{{ __('app.view_role') }}</a>
                        <a href="{{ route('role.edit', $role) }}" class="btn btn-light btn-active-light-primary my-1"
                            data-bs-target="#kt_modal_update_role">{{ __('app.edit_role') }}</a>
                    </div>
                    <!--end::Card footer-->
                </div>
                <!--end::Card-->
            </div>
        @endforeach
        <!--end::Col-->
        <!--begin::Add new card-->
        <div class="ol-md-4">
            <!--begin::Card-->
            <div class="card h-md-100">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-center">
                    <!--begin::Button-->
                    <a href="{{ route('role.create') }}" class="btn btn-clear d-flex flex-column flex-center">
                        <!--begin::Illustration-->
                        <img src="{{ asset('assets/media/illustrations/sigma-1/4.png') }}" alt=""
                            class="mw-100 mh-150px mb-7" />
                        <!--end::Illustration-->
                        <!--begin::Label-->
                        <div class="fw-bolder fs-3 text-gray-600 text-hover-primary">{{ __('app.add_new_role') }}</div>
                        <!--end::Label-->
                    </a>
                    <!--begin::Button-->
                </div>
                <!--begin::Card body-->
            </div>
            <!--begin::Card-->
        </div>
        <!--begin::Add new card-->
    </div>
@endsection
