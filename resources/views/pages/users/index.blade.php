@extends('layouts.app')
@section('content')
    <div class="d-flex flex-wrap flex-stack pb-7">
        <!--begin::Title-->
        {{-- <div class="d-flex flex-wrap align-items-center my-1">
            <h3 class="fw-bolder me-5 my-1">Users (38)</h3>
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-3 position-absolute ms-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                            transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                        <path
                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <input type="text" id="kt_filter_search"
                    class="form-control form-control-sm border-body bg-body w-150px ps-10" placeholder="Search" />
            </div>
            <!--end::Search-->
        </div> --}}
        <!--end::Title-->
        <!--begin::Controls-->
        {{-- <div class="d-flex flex-wrap my-1">
            <!--begin::Tab nav-->
            <ul class="nav nav-pills me-6 mb-2 mb-sm-0">
                <li class="nav-item m-0">
                    <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary me-3 active"
                        data-bs-toggle="tab" href="#kt_project_users_card_pane">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="currentColor" />
                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="currentColor" opacity="0.3" />
                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="currentColor" opacity="0.3" />
                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="currentColor" opacity="0.3" />
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </a>
                </li>
                <li class="nav-item m-0">
                    <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary" data-bs-toggle="tab"
                        href="#kt_project_users_table_pane">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                    fill="currentColor" />
                                <path opacity="0.3"
                                    d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </a>
                </li>
            </ul>
            <!--end::Tab nav-->
            <!--begin::Actions-->
            <div class="d-flex my-0">
                <!--begin::Select-->
                <select name="status" data-control="select2" data-hide-search="true" data-placeholder="Filter"
                    class="form-select form-select-sm border-body bg-body w-150px me-5">
                    <option value="1">Recently Updated</option>
                    <option value="2">Last Month</option>
                    <option value="3">Last Quarter</option>
                    <option value="4">Last Year</option>
                </select>
                <!--end::Select-->
                <!--begin::Select-->
                <select name="status" data-control="select2" data-hide-search="true" data-placeholder="Export"
                    class="form-select form-select-sm border-body bg-body w-100px">
                    <option value="1">Excel</option>
                    <option value="1">PDF</option>
                    <option value="2">Print</option>
                </select>
                <!--end::Select-->
            </div>
            <!--end::Actions-->
        </div> --}}
        <!--end::Controls-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Tab Content-->
    <div class="tab-content">
        <!--begin::Tab pane-->
        <div id="kt_project_users_card_pane" class="tab-pane fade show active">
            <!--begin::Row-->
            <div class="row g-6 g-xl-9">
                <!--begin::Col-->
                @foreach ($users as $user)
                    <div class="col-md-6 col-xxl-4">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body d-flex flex-start flex-column pt-12 p-9">
                                <div class="d-flex gap-7 align-items-start">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-circle symbol-100px">
                                        <img src="{{ asset('/assets/media//avatars/blank.png') }}" alt="image">
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Contact details-->
                                    <div class="d-flex flex-column w-100 gap-2">
                                        <!--begin::Name-->
                                        <div class="flex-row d-flex">
                                            <h3 class="d-flex mb-0">{{ $user->name }}</h3>
                                            <a class="d-flex ms-auto"
                                               href="{{ route('user.edit', ['user' => $user]) }}">
                                                {{ __('app.edit') }}</a>
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="d-flex align-items-center gap-2">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                          d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                          fill="currentColor"></path>
                                                    <path
                                                        d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                        fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <a href="#" class="text-muted text-hover-primary">{{ $user->email }}</a>
                                        </div>
                                        <!--end::Email-->
                                        <!--begin::Phone-->
                                        <div class="d-flex align-items-center gap-2">
                                            <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z"
                                                        fill="currentColor"></path>
                                                    <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <a href="#"
                                               class="text-muted text-hover-primary">{{ optional($user->expert)->phone }}</a>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <form action="{{route('password.default',$user)}}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-link text-danger">Reset Password
                                                </button>
                                            </form>
                                        </div>
                                        <!--end::Phone-->
                                    </div>
                                    <!--end::Contact details-->
                                </div>
                            </div>
                            <!--begin::Avatar-->
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                @endforeach
                <!--end::Col-->
                <!--begin::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Pagination-->
            <div class="d-flex flex-stack flex-wrap pt-10">
                {{ $users->links() }}
            </div>
            <!--end::Pagination-->
        </div>
        <!--end::Tab pane-->
    </div>
    <!--end::Tab Content-->
@endsection
