@extends('layouts.app')
@section('content')
    <div class="card">
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
            $('#filterApply').on('click',function(){
                var status = $('#globalFilter select#status_id').select2('val');
                var commissioning = $('#globalFilter input[name="commissioning"]:checked').val();
                var searchText = ((jQuery.type(status) === "undefined")?'':status) + ' ' + ((jQuery.type(commissioning) === "undefined")?'':commissioning);
                table.search(searchText).draw();
            })
        });
    </script>
@endpush
