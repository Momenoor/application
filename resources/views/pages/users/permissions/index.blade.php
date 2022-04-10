@extends('layouts.app')
@section('content')
    <div class="card">
        @include('common._table_toolbar')
        <div class="card-body">
            <!--begin::Table-->
            {{ $dataTable->table() }}
            <!--end::Table-->
        </div>
    </div>
    {{-- Inject Scripts --}}
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
    @once
        <script src="{{ asset('assets/js/buttons.server-side.js') }}"></script>
    @endonce
    <script type="text/javascript">
        $(document).ready(function() {
            var table = window.LaravelDataTables["permission-table"];
            var searchInput = $('input[type="search"]');

            $(document).on('init.dt', function(e, settings) {

                if (table.state.loaded() !== null) {
                    var searchedText = table.state.loaded().search.search ?? null;
                    searchInput.val(searchedText);
                }
            });

            searchInput.on('search', function() {

                var searchText = $(this).val();
                table.search(searchText).draw();
            });

            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [{
                        extend: 'copyHtml5',
                        title: 'permission + {{ now() }}'
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'permission + {{ now() }}'
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'permission + {{ now() }}'
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'permission + {{ now() }}'
                    },
                    {
                        extend: 'create',
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
