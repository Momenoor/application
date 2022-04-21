<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0 cursor-pointer">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('app.matter-data') }}</h3>
        </div>
        <div class="d-flex align-self-center">
            @can('matter-delete')
                <form id="delete" action="{{ route('matter.destroy', $matter) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button class="btn btn-sm btn-icon btn-danger btn-active-danger me-2" type="submit"
                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                        data-bs-original-title="{{ __('app.delete') }}">
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                    fill="black" />
                                <path opacity="0.5"
                                    d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                    fill="black" />
                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                    fill="black" />
                            </svg>
                        </span>
                    </button>
                </form>
                @push('scripts')
                    <script>
                        $('#delete').on('submit', function(e) {
                            e.preventDefault();
                            Swal.fire({
                                text: "{{ __('app.are_you_sure_to_delete_record') }}",
                                icon: "error",
                                buttonsStyling: false,
                                showCancelButton: true,
                                confirmButtonText: "{{ __('app.ok') }}",
                                cancelButtonText: "{{ __('app.cancel') }}",
                                customClass: {
                                    confirmButton: "btn btn-danger",
                                    cancelButton: 'btn btn-light',
                                }
                            }).then(function(result) {
                                if (result.isConfirmed) {
                                    e.target.submit();
                                }
                            });
                        });
                    </script>
                @endpush
            @endcan
            @can('matter-create')
                <a href="#" class="btn btn-sm btn-icon btn-primary btn-active-primary me-2" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="" data-bs-original-title="{{ __('app.copy') }}">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen028.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="7" y="2" width="14" height="16" rx="3" fill="currentColor"></rect>
                            <rect x="3" y="6" width="14" height="16" rx="3" fill="currentColor"></rect>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </a>
            @endcan
            <a href="#" class="btn btn-sm btn-icon btn-primary btn-active-primary me-2" data-bs-toggle="tooltip"
                data-bs-placement="top" title="" data-bs-original-title="{{ __('app.back') }}">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr076.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(-1 0 0 1 15.5 11)"
                            fill="currentColor"></rect>
                        <path
                            d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z"
                            fill="currentColor"></path>
                        <path
                            d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z"
                            fill="#C4C4C4"></path>
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </a>
        </div>

        <!--end::Card title-->
    </div>
    <div class="card-body pt-0">
        <div class="separator"></div>
        <div class="row mt-10">
            <div class="col-6">
                <div class="row mb-10">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('app.court') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ $matter->court->name }}</span>
                        @include('common.external-link', [
                            'href' => route('court.show', $matter->court),
                        ])
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-10">
                    <!--begin::Label-->
                    <label class="col-lg-4 fw-bold text-muted">{{ __('app.type') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ $matter->type->name }}</span>
                    </div>
                    <!--end::Col-->
                </div>
            </div>
            <div class="col-6">
                <div class="row mb-10">
                    <label class="col-4 fw-bold text-muted">{{ __('app.commissioning') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-8">
                        <span class="fw-bolder fs-6 text-gray-800">{{ __('app.' . $matter->commissioning) }}</span>
                    </div>
                </div>
                <div class="row mb-10">
                    <label class="col-4 fw-bold text-muted">{{ __('app.status') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-8">
                        <span
                            class="fw-bolder fs-6 text-gray-800">{{ $matter->parent_id > 0 ? __('app.supplementary') : __('app.basic') }}</span>
                        @if ($matter->parent_id > 0)
                            @include('common.external-link', [
                                'href' => route('matter.show', $matter->parent_id),
                            ])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
