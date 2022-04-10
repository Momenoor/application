@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" method="POST" action="{{ route('role.store') }}">
                @csrf
                <!--begin::Scroll-->
                <div class="d-flex flex-column scroll-y me-n7 pe-7">
                    <!--begin::Input group-->
                    <div class="fv-row mb-10 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="fs-5 fw-bolder form-label mb-2">
                            <span class="required">{{ __('app.name') }}</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid @error('name') is-invalid @enderror "
                            placeholder="{{ __('app.enter-a-role-name') }}" name="name">
                        <!--end::Input-->
                        @error('name')
                            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end::Input group-->
                    <!--begin::Permissions-->
                    <div class="fv-row">
                        <!--begin::Label-->
                        <label class="fs-5 fw-bolder form-label mb-2">{{ __('app.role-permissions') }}</label>
                        <!--end::Label-->
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-bold">
                                    <!--begin::Table row-->
                                    <tr>
                                        <td class="text-gray-800">{{ __('app.administrator-access') }}
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                                title="Allows a full access to the system"></i>
                                        </td>
                                        <td>
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-9">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="kt_roles_select_all" />
                                                <span class="form-check-label"
                                                    for="kt_roles_select_all">{{ __('app.select-all') }}</span>
                                            </label>
                                            <!--end::Checkbox-->
                                        </td>
                                    </tr>
                                    <!--end::Table row-->
                                    <!--begin::Table row-->
                                    @foreach ($permissions as $key => $permission)
                                        <tr>
                                            <!--begin::Label-->
                                            <td class="text-gray-800">{{ $key }}</td>
                                            <!--end::Label-->
                                            <!--begin::Options-->
                                            <td>
                                                <!--begin::Wrapper-->
                                                <div class="d-flex">
                                                    <!--begin::Checkbox-->
                                                    @foreach ($permission as $perm)
                                                        @include(
                                                            'pages.users.roles._permission',
                                                            ['perm' => $perm]
                                                        )
                                                    @endforeach
                                                </div>
                                                <!--end::Wrapper-->
                                            </td>
                                            <!--end::Options-->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end::Permissions-->
                </div>
                <!--end::Scroll-->
                <!--begin::Actions-->
                <div class="pt-15">
                    <button type="reset" class="btn btn-light me-3"
                        data-kt-permissions-modal-action="cancel">{{ __('app.reset') }}</button>
                    <button type="submit" class="btn btn-primary" data-kt-permissions-modal-action="submit">
                        <span class="indicator-label">{{ __('app.save') }}</span>
                    </button>
                </div>
                <!--end::Actions-->
                <div></div>
            </form>
        </div>
    </div>
@endsection
