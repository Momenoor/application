@php
$n = 1;
@endphp
@if (count($items) > 0)
    @foreach ($items as $item)
        <tr>
            <td>
                <div class="symbol symbol-45px me-2">
                    <span class="symbol-label">
                        <span
                            class="symbol-label bg-{{ $item->color() }} text-light-{{ $item->color() }} fw-bolder">{{ $item->symbol() . $n }}</span>
                    </span>
                </div>
            </td>
            <td>
                <a href="#" class="text-dark fw-bold text-hover-{{ $item->color() }} mb-1 fs-6">{{ $item->name }}</a>
                <span class="text-muted fw-bold d-block">{{ __('app.' . $item->category()) }}</span>
            </td>
            <td class="m-auto text-muted fw-bold">{{ __('app.' . $item->field()) }}</td>
            <td class="ms-5">
                <span class="badge badge-{{ $item->color() }}">{{ __('app.' . $item->pivotType()) }}</span>
            </td>
            <td class="text-end">
                @if ($source == 'edit' && $item->pivotType() != 'expert')
                    @can('party-unlink')
                        <form class="delete"
                            action="{{ route('matter.party-unlink', ['matter' => $matter, 'party' => $item]) }}"
                            method="POST">
                            @method('delete')
                            @csrf
                            @form_hidden('type','expert')
                            <button class="btn btn-sm btn-icon btn-danger btn-active-danger me-2" type="submit"
                                data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="{{ __('app.delete') }}">
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
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
                                $('.delete').on('submit', function(e) {
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
                @else
                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-{{ $item->color() }}">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                    transform="rotate(-180 18 13)" fill="black" />
                                <path
                                    d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </a>
                @endif
            </td>
        </tr>
        @php
            $n++;
        @endphp
    @endforeach
@endif
