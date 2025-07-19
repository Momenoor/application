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
    @include('common.table_search_script', ['tableName' => 'request-table'])
    <script>Dropzone.autoDiscover = false;

        document.querySelectorAll('.modal').forEach(function(modal) {
            modal.addEventListener('shown.bs.modal', function () {
                modal.querySelectorAll('.dropzone').forEach(function (el) {
                    if (el.classList.contains('dz-clickable')) return; // Already initialized

                    const inputId = el.dataset.input;

                    new Dropzone(el, {
                        url: '{{ route('dropzone.upload') }}',
                        paramName: 'file',
                        maxFiles: 1,
                        maxFilesize: 10,
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        addRemoveLinks: true,
                        success: function (file, response) {
                            document.getElementById(inputId).value = response.file_path;
                        },
                        error: function (file, message) {
                            console.error('Upload failed:', message);
                        }
                    });
                });
            });
        });
    </script>

@endpush
