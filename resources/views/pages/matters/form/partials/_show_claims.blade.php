<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header border-bottom mt-6 ribbon ribbon-end ribbon-clip">
        <div class="ribbon-label">
            {{ __('app.' . $matter->claim_status) }}
            <span class="ribbon-inner bg-{{ $matter->claim_status_color }}"></span>
        </div>
        <!--begin::Card title-->
        <div class="card-title flex-column">
            <h3 class="fw-bolder mb-1">{{ __('app.claims') }}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body p-9 pt-3">
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle gs-0 gy-4 my-0">
                <!--begin::Table head-->
                <thead>
                    <tr class="fs-7 fw-bolder text-gray-500">
                        <th class="p-0 min-w-100px d-block pt-3">{{ __('app.date') }}</th>
                        <th class="min-w-140px text-center pt-3">{{ __('app.type') }}</th>
                        <th class="min-w-140px text-center pt-3">{{ __('app.recurring') }}</th>
                        <th class="pe-0 text-center min-w-120px pt-3">{{ __('app.amount') }}</th>
                        @if ($source == 'edit')
                            @can('claim-delete')
                                <th class="pe-0 text-center pt-3">#</th>
                            @endcan
                        @endif
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                    @foreach ($matter->claims as $claim)
                        <tr>
                            <td>
                                <a href="#"
                                    class="text-gray-800 fw-bolder text-hover-primary mb-1">{{ $claim->date->format('Y-m-d') }}</a>
                            </td>
                            <td class="text-center">
                                <span
                                    class="badge badge-light-{{ $claim->type_color }} fw-bolder">{{ __('app.' . \Str::lower($claim->type)) }}</span>
                            </td>
                            <td class="text-center">
                                <span
                                    class="badge badge-light-{{ $claim->recurring_color }} fw-bolder">{{ __('app.' . \Str::lower($claim->recurring)) }}</span>
                            </td>
                            <td class="text-center">
                                <span class="text-gray-800 fw-bolder d-block">{{ $claim->claim_amount }} AED</span>
                            </td>
                            @if ($source == 'edit')
                                @can('claim-delete')
                                    <td class="text-center">
                                        <form id="delete" action="{{ route('claim.destroy', $claim) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-icon btn-danger btn-active-danger me-2"
                                                type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="{{ __('app.delete') }}">
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                            fill="black" />
                                                        <path opacity="0.5"
                                                            d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                            fill="black" />
                                                        <path opacity="0.5"
                                                            d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
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
                                    </td>
                                @endcan
                            @endif
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-top">
                        <th class="text-center text-gray-800 fw-bolder fs-6" colspan="3">{{ __('app.total') }}</th>
                        <th class="text-center text-gray-800 fw-bolder d-block fs-6">{{ $matter->claims_sum_amount }}
                            AED</th>
                    </tr>
                    <tr class="border-top">
                        <th class="text-center text-gray-800 fw-bolder fs-6" colspan="3">{{ __('app.collected') }}
                        </th>
                        <th class="text-center text-success fw-bolder d-block fs-6">{{ $matter->cash_sum_amount }}
                            AED
                        </th>
                    </tr>
                    @if ($matter->claimsOpen())
                        <tr>
                            <td colspan="4" class="text-end">
                                <button type="button" class="btn btn-success btn-sm w-25" data-bs-toggle="modal"
                                    data-bs-target="#collectionModal">{{ __('app.collect') }}</button>
                            </td>
                        </tr>
                    @endif
                </tfoot>
                <!--end::Table body-->
            </table>
        </div>
    </div>
</div>
