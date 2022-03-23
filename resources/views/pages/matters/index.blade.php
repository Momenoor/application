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

                var searchedText = table.state.loaded().search.search;
                searchInput.val(searchedText);
                var searchedStatus = table.state.loaded().columns[1].search.search;
                statusSelectInput.val(searchedStatus).change();
                var searchedCommissioning = table.state.loaded().columns[3].search.search;
                $('#globalFilter input[name="commissioning"][value="' + searchedCommissioning + '"]').prop(
                    'checked', 'checked');

            });

            searchInput.on('search', function() {

                var searchText = $(this).val();
                table.search(searchText).draw();
            });

            resetBtn.on('click', function() {
                table.column(3).search('');
                table.column(1).search('').draw();
            });

            filterBtn.on('click', function() {

                var status = statusSelectInput.select2('val');
                var commissioning = $('#globalFilter input[name="commissioning"]:checked').val();
                table.column(3).search(commissioning);
                table.column(1).search(status).draw();
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
