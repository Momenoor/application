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
    <div class="card-body col-12 scroll-y h-300px">

        <!--begin::Messages-->
        <!--begin::Message(in)-->
        @foreach ($notes as $note)
            <div class="mb-10">
                    <!--begin::User-->
                    <div class="d-flex mb-2">
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

                    <div class="d-flex w-100">
                        <div class="p-5 rounded bg-light-info text-dark fw-bold text-start"
                            data-kt-element="message-text">{{ $note->text }}</div>
                        <div class="ms-auto">
                            <button wire:click="confirmDelete({{ $note->id }})"
                                class="btn btn-icon btn-light-danger btn-active-color-light btn-sm">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.5"
                                            d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.5"
                                            d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </button>
                        </div>
                    </div>
                <!--end::Wrapper-->
            </div>
        @endforeach
        <!--end::Message(in)-->
    </div>
    <!--end::Card body-->
    <!--begin::Card footer-->
    <div class="card-footer pt-4" id="kt_chat_messenger_footer">
        <!--begin::Input-->
        <textarea wire:model="note" class="form-control form-control-flush mb-3" rows="1" data-kt-element="input"
            placeholder="{{ __('app.type-note') }}"></textarea>
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
            <button class="btn btn-primary" type="button" wire:click="send">{{ __('app.send') }}</button>
            <!--end::Send-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Card footer-->
</div>
<!--end::Messenger-->
