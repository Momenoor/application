@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            @if ($isUpdate)
                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)"
                                fill="currentColor"></rect>
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)"
                                fill="currentColor"></rect>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-bold">
                            <div class="fs-6 text-gray-700">
                                <strong class="me-1">Warning! </strong>By editing the permission name, you might
                                break the system permissions functionality. Please ensure you're absolutely certain before
                                proceeding.
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
            @endif
            <form id="permissionCreate" method="POST" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="
                                @if ($isUpdate) {{ route('permission.update', ['permission' => $permission]) }}
                @else
                {{ route('permission.store') }} @endif
                                ">
                @csrf
                @if ($isUpdate)
                    @method('PATCH')
                @endif
                <!--begin::Input group-->
                <div class="fv-row mb-7 col-6 fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="required">{{ __('app.name') }}</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover"
                            data-bs-html="true" data-bs-content="Permission names is required to be unique."
                            data-bs-original-title="" title=""></i>
                    </label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input class="form-control form-control-solid @error('name') is-invalid @enderror" placeholder="{{ __('app.enter-a-permission-name') }}"
                        name="name" value="{{ $permission->name ?? old('name') }}">
                    <!--end::Input-->
                    @error('name')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                {{-- <div class="fv-row mb-7">
                    <!--begin::Checkbox-->
                    <label class="form-check form-check-custom form-check-solid me-9">
                        <input class="form-check-input" type="checkbox" value="" name="permissions_core"
                            id="kt_permissions_core">
                        <span class="form-check-label" for="kt_permissions_core">Set as core permission</span>
                    </label>
                    <!--end::Checkbox-->
                </div>
                <!--end::Input group-->
                <!--begin::Disclaimer-->
                <div class="text-gray-600">Permission set as a
                    <strong class="me-1">Core Permission</strong>will be locked and
                    <strong class="me-1">not editable</strong>in future
                </div> --}}
                <!--end::Disclaimer-->
                <!--begin::Actions-->
                <div class="pt-15">
                    <button type="reset" class="btn btn-light me-3"
                        data-kt-permissions-modal-action="cancel">{{ __('app.reset') }}</button>
                    <button type="submit" class="btn btn-primary" data-kt-permissions-modal-action="submit">
                        <span class="indicator-label">{{ __('app.save') }}</span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
        </div>
    </div>
@endsection
