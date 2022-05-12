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
    @once
        <script src="{{ asset('assets/js/buttons.server-side.js') }}"></script>
    @endonce
    {{ $dataTable->scripts() }}
    @include('common.table_search_script', ['tableName' => 'type-table'])
@endpush
