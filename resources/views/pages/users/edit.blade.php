@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h2 class="fw-bolder">{{ __('app.update_user_details') }}</h2>
            </div>
        </div>
        <div class="card-body col-8">
            <form class="form" method="POST" action="{{ route('user.update', $user) }}"
                id="kt_modal_update_user_form">
                @csrf
                @method('PUT')
                <!--begin::Modal body-->
                <div class="py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column me-n7 pe-7">
                        <!--begin::User toggle-->
                        <div class="fw-boldest fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
                            href="#kt_modal_update_user_user_info" role="button" aria-expanded="false"
                            aria-controls="kt_modal_update_user_user_info">{{ __('app.user_information') }}
                            <span class="ms-2 rotate-180">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::User toggle-->
                        <!--begin::User form-->
                        <div id="kt_modal_update_user_user_info" class="collapse show">
                            <!--begin::Input group-->
                            <div class="mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">
                                    <span>{{ __('app.update_avatar') }}</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="Allowed file types: png, jpg, jpeg."></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Image input wrapper-->
                                <div class="mt-1">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true"
                                        style="background-image: url({{ asset('assets/media/svg/avatars/blank.png') }})">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url({{ asset('assets/media/avatars/' . $user->avatar) }})">
                                        </div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Edit-->
                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                            title="{{ __('app.change_avatar') }}">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit-->
                                        <!--begin::Cancel-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                            title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                </div>
                                <!--end::Image input wrapper-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">{{ __('app.name') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text"
                                    class="form-control form-control-solid @error('name') is-invalid @enderror"
                                    placeholder="" name="name" value="{{ old('name', $user->name) }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">
                                    <span>{{ __('app.email') }}</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                        title="{{ 'app.email_address_must_be_active' }}"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text"
                                    class="form-control form-control-solid @error('email') is-invalid @enderror"
                                    placeholder="" name="email" value="{{ old('email', $user->email) }}" />
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">
                                    <span>{{ __('app.display_name') }}</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text"
                                    class="form-control form-control-solid @error('display_name') is-invalid @enderror"
                                    placeholder="" name="display_name"
                                    value="{{ old('display_name', $user->display_name) }}" />
                                @error('display_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-15">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">{{ __('app.language') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="language" aria-label="Select a Language" data-control="select2"
                                    data-placeholder="{{ __('app.select_a_language') }}..."
                                    class="form-select form-select-solid @error('language') is-invalid @enderror">
                                    <option></option>
                                    @foreach ($languages as $key => $lang)
                                        <option value="{{ $key }}"
                                            @if (old('language', $user->language) == $key) selected @endif>
                                            {{ data_get($lang, 'text') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('language')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-15">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">{{ __('app.gender') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div class="d-flex">
                                    <label class="form-check form-check-custom form-check-solid me-10">
                                        <input class="form-check-input @error('gender') is-invalid @enderror" name="gender"
                                            type="radio" value="male"
                                            @if (old('name', $user->gender) == 'male') checked="checked" @endif />
                                        <span class="form-check-label">
                                            {{ __('app.male') }}
                                        </span>
                                    </label>

                                    <!--end::Input-->
                                    <!--begin::Input-->
                                    <label class="form-check form-check-custom form-check-danger form-check-solid me-10">
                                        <input class="form-check-input @error('gender') is-invalid @enderror" name="gender"
                                            type="radio" value="female"
                                            @if (old('gender', $user->gender) == 'female') checked="checked" @endif />
                                        <span class="form-check-label">
                                            {{ __('app.female') }}
                                        </span>
                                    </label>
                                </div>
                                @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-15">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">{{ __('app.role') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="role" aria-label="Select a Role" data-control="select2"
                                    data-placeholder="{{ __('app.select_a_role') }}..."
                                    class="form-select form-select-solid ">
                                    <option></option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            @if (old('role', $user->hasRole($role->id))) selected @endif>
                                            {{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <div class="fv-row mb-15">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">{{ __('app.assigned_expert') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="expert" aria-label="Select a Expert" data-control="select2"
                                    data-placeholder="{{ __('app.select_an_expert') }}..."
                                    class="form-select form-select-solid @error('expert') is-invalid @enderror">
                                    <option></option>
                                    @foreach ($experts as $expert)
                                        <option value="{{ $expert->id }}"
                                            @if (old('expert', optional($user->expert)->id) == $expert->id) selected @endif>
                                            {{ '[' . $expert->id . '] - ' . $expert->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('language')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::User form-->
                        <!--begin::Address toggle-->
                        {{-- <div class="fw-boldest fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
                            href="#kt_modal_update_user_address" role="button" aria-expanded="false"
                            aria-controls="kt_modal_update_user_address">{{ 'app.security_details' }}
                            <span class="ms-2 rotate-180">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Address toggle-->
                        <!--begin::Address form-->
                        <div id="kt_modal_update_user_address" class="collapse show">
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-7 fv-row">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">{{ 'app.old_password' }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="password" class="form-control form-control-solid" placeholder=""
                                    name="old_password" value="101, Collins Street" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row fv-plugins-icon-container" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bolder text-dark fs-6">Password</label>
                                    <!--end::Label-->
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control form-control-lg form-control-solid" type="password"
                                            placeholder="" name="password" autocomplete="off">
                                        <span
                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                            data-kt-password-meter-control="visibility">
                                            <i class="bi bi-eye-slash fs-2"></i>
                                            <i class="bi bi-eye fs-2 d-none"></i>
                                        </span>
                                    </div>
                                    <!--end::Input wrapper-->
                                    <!--begin::Meter-->
                                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                    <!--end::Meter-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Hint-->
                                <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp;
                                    symbols.</div>
                                <!--end::Hint-->
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Input group-->
                            <div class="fv-row mb-10 fv-plugins-icon-container">
                                <label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>
                                <input class="form-control form-control-lg form-control-solid" type="password"
                                    placeholder="" name="confirm-password" autocomplete="off">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div> --}}
                        <!--end::Address form-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <a href="{{ route('user.index') }}" class="btn btn-light me-3">{{ __('app.cancel') }}</a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                        <span class="indicator-label">{{ __('app.save') }}</span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
        </div>
    </div>
@endsection
