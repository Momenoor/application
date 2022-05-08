@if (!$matter->isReported())
    <form class="change-status" method="POST"
        action="{{ route('matter.change-status', ['matter' => $matter, 'status' => 'reported']) }}">
        @csrf
        <button type="submit" class="btn btn-sm btn-warning me-3">{{ __('app.mark-as-reported') }}</button>
    </form>
@elseif($matter->isReported() && !$matter->isSubmitted())
    <form class="change-status" method="POST"
        action="{{ route('matter.change-status', ['matter' => $matter, 'status' => 'submitted']) }}">
        @csrf
        <button type="submit" class="btn btn-sm btn-success me-3">{{ __('app.mark-as-submitted') }}</button>
    </form>
@endif
@push('scripts')
    <script>
        $('.change-status').on('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                text: "{{ __('app.are_you_sure_to_change_status') }}",
                icon: "info",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "{{ __('app.ok') }}",
                cancelButtonText: "{{ __('app.cancel') }}",
                customClass: {
                    confirmButton: "btn btn-info",
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
