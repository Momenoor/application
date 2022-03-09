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
<script src="{{asset('assets/js/buttons.server-side.js')}}"></script>    
{{ $dataTable->scripts() }}
@endpush
