<div class="card" id="kt_chat_messenger">
    <!--begin::Card header-->
    <div class="card-header" id="kt_chat_messenger_header">
        <!--begin::Title-->
        <div class="card-title">
            <!--begin::User-->
            <div class="d-flex justify-content-center flex-column me-3">
                <a href="#"
                    class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">{{ __('app.notes') }}</a>
            </div>
            <!--end::User-->
        </div>
        <!--end::Title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body" id="kt_chat_messenger_body">
        <!--begin::Messages-->
        <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto">
            <!--begin::Message(in)-->
            @foreach ($matter->notes as $note)
                <div class="d-flex justify-content-start mb-10">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column align-items-start">
                        <!--begin::User-->
                        <div class="d-flex align-items-center mb-2">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle">
                                <img alt="Pic" src="{{ asset('assets/media/avatars/blank.png') }}" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Details-->
                            <div class="ms-3">
                                <a href="{{ route('user.show', $note->user) }}"
                                    class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">{{ $note->user->name }}</a>
                                <span class="text-muted fs-7 mb-1">{{ $note->datetime->diffForHumans() }}</span>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::User-->
                        <!--begin::Text-->
                        <div class="p-5 rounded bg-light-info text-dark fw-bold mw-lg-400px text-start"
                            data-kt-element="message-text">{{ $note->text }}</div>
                        <!--end::Text-->
                    </div>
                    <!--end::Wrapper-->
                </div>
            @endforeach
            <!--end::Message(in)-->
        </div>
        <!--end::Messages-->
    </div>
    <!--end::Card body-->
    <!--begin::Card footer-->
    <div class="card-footer pt-4" id="kt_chat_messenger_footer">
        <!--begin::Input-->
        <textarea class="form-control form-control-flush mb-3" rows="1" data-kt-element="input"
            placeholder="Type a message"></textarea>
        <!--end::Input-->
        <!--begin:Toolbar-->
        <div class="d-flex flex-stack">
            <!--begin::Actions-->
            <div class="d-flex align-items-center me-2">
                <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip"
                    title="Coming soon">
                    <i class="bi bi-paperclip fs-3"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip"
                    title="Coming soon">
                    <i class="bi bi-upload fs-3"></i>
                </button>
            </div>
            <!--end::Actions-->
            <!--begin::Send-->
            <button class="btn btn-primary" type="button" data-kt-element="send">Send</button>
            <!--end::Send-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Card footer-->
</div>
<!--end::Messenger-->
</div>
