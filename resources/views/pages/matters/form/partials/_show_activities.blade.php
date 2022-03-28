<div class="card card-xl-stretch">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="fw-bolder mb-2 text-dark">{{ __('app.activities') }}</span>
            <span
                class="text-muted fw-bold fs-7">{{ __(trans_choice('app.activity', $matter->procedures->count())) }}</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-5">
        <!--begin::Timeline-->
        <div class="timeline-label-100 timeline-label">
            <!--begin::Item-->
            @foreach ($matter->procedures->sortBy('datetime') as $procedure)
                <div class="timeline-item">
                    <!--begin::Label-->
                    <div class="timeline-label-100 fw-bolder text-gray-800 fs-6">
                        {{ $procedure->datetime->format('Y-m-d') }}</div>
                    <!--end::Label-->
                    <!--begin::Badge-->
                    <div class="timeline-badge">
                        <i
                            class="fa fa-genderless text-{{ Arr::random(['warning', 'danger', 'success', 'info', 'dark']) }} fs-1"></i>
                    </div>
                    <!--end::Badge-->
                    <!--begin::Text-->
                    <div class="fw-mormal timeline-content text-muted ps-3">{{ __('app.' . $procedure->description) }}
                    </div>
                    <!--end::Text-->
                </div>
            @endforeach
            <!--end::Item-->
        </div>
        <!--end::Timeline-->
    </div>
    <!--end: Card Body-->
</div>
<!--end: List Widget 5-->
