<div>
    @if (!$matter->isReported())
        <button wire:click="changeStatusConfirm('reported')"
            class="btn btn-sm btn-bg-light btn-active-color-primary me-3">{{ __('app.mark-as-reported') }}</button>
    @elseif($matter->isReported() && !$matter->isSubmitted())
        <button wire:click="changeStatusConfirm('submitted')"
            class="btn btn-sm btn-bg-light btn-active-color-primary me-3">{{ __('app.mark-as-submitted') }}</button>
    @endif
</div>
