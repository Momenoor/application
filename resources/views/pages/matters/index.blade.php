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

        });
    </script>
@endpush
