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
            var searchInput = $('#matter-toolbar input[type="search"]');
            var resetBtn = $('#globalFilter #filterReset');
            var filterBtn = $('#globalFilter #filterApply');
            var statusSelectInput = $('#globalFilter select#status_id');

            $(document).on('init.dt', function(e, settings) {

                if (table.state.loaded() !== null) {
                    var searchedText = table.state.loaded().search.search ?? null;
                    searchInput.val(searchedText);
                }
                if (table.state.loaded() !== null) {
                    var searchedStatus = table.state.loaded().columns[2].search.search;
                    statusSelectInput.val(searchedStatus).change();
                    var searchedCommissioning = table.state.loaded().columns[4].search.search;
                    var searchedCommissioning = table.state.loaded().columns[3].search.search;
                    var searchedCategory = table.state.loaded().search.search;
                    var searchedClaimStatus = table.state.loaded().columns[7].search.search;
                    $('#globalFilter input[name="commissioning"][value="' + searchedCommissioning + '"]')
                        .prop(
                            'checked', 'checked');
                    $('#globalFilter input[name="category"][value="' + searchedCategory + '"]')
                        .prop(
                            'checked', 'checked');
                    $('#globalFilter input[name="claimsCollectionStatus"][value="' + searchedClaimStatus +
                            '"]')
                        .prop(
                            'checked', 'checked');
                }

            });

            table.on('draw', function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            })

            searchInput.on('search', function() {

                var searchText = $(this).val();
                table.search(searchText).draw();
            });

            resetBtn.on('click', function() {
                table.column(3).search('');
                table.column(6).search('');
                table.column(2).search('');
                table.search('');
                table.column(1).search('').draw();
                statusSelectInput.val("").trigger('change');
                $('input[name="commissioning"][value=""]').prop('checked', true);
                $('input[name="category"][value=""]').prop('checked', true);
                $('input[name="claimsCollectionStatus"][value=""]').prop('checked', true);
            });

            filterBtn.on('click', function() {

                var status = statusSelectInput.select2('val');
                var commissioning = $('#globalFilter input[name="commissioning"]:checked').val();
                var category = $('#globalFilter input[name="category"]:checked').val();
                //table.column(1).search(claimStatus);
                var claimStatus = $('input[name="claimsCollectionStatus"]:checked').val();

                table.column(4).search(commissioning);
                table.column(3).search(category);
                table.column(7).search(claimStatus);
                table.column(2).search(status).draw();

            });

            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [{
                        extend: 'copyHtml5',
                        title: 'e'
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'e'
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'e'
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'e'
                    }
                ]
            })

            buttons.container().appendTo($('.datatable-buttons'));
            var exportValue = null;
            $('#modal-datatable-export .form-select').on('change', function() {
                exportValue = $(this).select2('val');
            });
            $('#modal-datatable-export .btn-export').on('click', function() {
                target = $('.dt-buttons .buttons-' + exportValue);
                target.click();
            })



        });
    </script>
@endpush
