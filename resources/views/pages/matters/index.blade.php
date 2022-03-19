@extends('layouts.app')
@section('content')
    <div class="card">
        @include('pages.matters.form.partials._table_toolbar')
        <div class="card-body">
            <!--begin::Table-->
            {{ $dataTable->table() }}
            <!--end::Table-->
        </div>
    </div>
    {{-- Inject Scripts --}}
@endsection
@push('scripts')
    @once
        <script src="{{ asset('assets/js/buttons.server-side.js') }}"></script>
    @endonce
    {{ $dataTable->scripts() }}
    <script type="text/javascript">
        $(document).ready(function() {
            var table = window.LaravelDataTables["matter-table"];
            $('#idFilter').html(
                '<div class="d-flex align-items-center position-relative my-1">' +
                '<span class="svg-icon svg-icon-1 position-absolute ms-4 ">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
                '<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>' +
                '<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black"></path>' +
                '</svg>' +
                '</span>' +
                '<input type="text" data-kt-ecommerce-product-filter="search" class=" justify-content-md-end form-control form-control-solid w-250px ps-14" placeholder="Search Product">' +
                '</div>'
            )
            $('#filterApply').on('click', function() {

                var status = $('#globalFilter select#status_id').select2('val');
                var commissioning = $('#globalFilter input[name="commissioning"]:checked').val();
                var searchText = ((jQuery.type(status) === "undefined") ? '' : status) + '|' + ((jQuery
                    .type(commissioning) === "undefined") ? '' : commissioning);
                table.column(3).search(commissioning);
                table.column(1).search(status).draw();
            })
        });
    </script>
@endpush
