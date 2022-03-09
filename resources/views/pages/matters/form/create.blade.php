@extends('layouts.app')
@section('content')
    <!--begin::Stepper-->
    <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid"
        id="kt_create_matter_stepper">
        <!--begin::Aside-->
        <div
            class="card d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px w-xxl-400px me-9">
            <!--begin::Wrapper-->
            <div class="card-body px-6 px-lg-10 px-xxl-15 py-20">
                <!--begin::Nav-->
                <div class="stepper-nav">
                    <!--begin::Step 1-->
                    <div class="stepper-item current" data-kt-stepper-element="nav">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->
                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">1</span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Label-->
                        <div class="stepper-label">
                            <h3 class="stepper-title">{{ __('app.basic_data') }}</h3>
                            <div class="stepper-desc fw-bold">Setup Your Account Details</div>
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Step 1-->
                    <!--begin::Step 2-->
                    <div class="stepper-item" data-kt-stepper-element="nav">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->
                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">2</span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Label-->
                        <div class="stepper-label">
                            <h3 class="stepper-title">{{ __('app.parties') }}</h3>
                            <div class="stepper-desc fw-bold">Setup Your Account Settings</div>
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Step 2-->
                    <!--begin::Step 3-->
                    <div class="stepper-item" data-kt-stepper-element="nav">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->
                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">3</span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Label-->
                        <div class="stepper-label">
                            <h3 class="stepper-title">{{ __('app.advanced_data') }}</h3>
                            <div class="stepper-desc fw-bold">Your Business Related Info</div>
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Step 3-->
                    <!--begin::Step 5-->
                    <div class="stepper-item" data-kt-stepper-element="nav">
                        <!--begin::Line-->
                        <div class="stepper-line w-40px"></div>
                        <!--end::Line-->
                        <!--begin::Icon-->
                        <div class="stepper-icon w-40px h-40px">
                            <i class="stepper-check fas fa-check"></i>
                            <span class="stepper-number">4</span>
                        </div>
                        <!--end::Icon-->
                        <!--begin::Label-->
                        <div class="stepper-label">
                            <h3 class="stepper-title">{{ __('app.save') }}</h3>
                            <div class="stepper-desc fw-bold">Woah, we are here</div>
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Step 5-->
                </div>
                <!--end::Nav-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="card d-flex flex-row-fluid flex-center">
            <!--begin::Form-->
            <form class="card-body py-20 w-100 w-xl-700px px-9" method="POST" action="{{ route('matter.store') }}"
                novalidate="novalidate" id="create_matter_form">
                <!--begin::Step 1-->
                <div class="current" data-kt-stepper-element="content">
                    @csrf
                    @include('pages.matters.form.steps.basic')
                </div>
                <!--end::Step 1-->
                <!--begin::Step 2-->
                <div data-kt-stepper-element="content">
                    @include('pages.matters.form.steps.parties')
                </div>
                <!--end::Step 2-->
                <!--begin::Step 3-->
                <div data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
                    @include('pages.matters.form.steps.advanced')
                </div>
                <!--end::Step 4-->
                <!--begin::Step 5-->
                <div data-kt-stepper-element="content">
                    <!--begin::Wrapper-->

                    <!--end::Wrapper-->
                </div>
                <!--end::Step 4-->
                <!--begin::Actions-->
                <div class="d-flex flex-stack pt-10">
                    <!--begin::Wrapper-->
                    <div class="mr-2">
                        <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                            <span class="svg-icon svg-icon-4 me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black" />
                                    <path
                                        d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->Back
                        </button>
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Wrapper-->
                    <div>
                        <button type="submit" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit">
                            <span class="indicator-label">Submit
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                <span class="svg-icon svg-icon-3 ms-2 me-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                            transform="rotate(-180 18 13)" fill="black" />
                                        <path
                                            d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                            fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continue
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                            <span class="svg-icon svg-icon-4 ms-1 me-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                        transform="rotate(-180 18 13)" fill="black" />
                                    <path
                                        d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Stepper-->

    @push('scripts')
        <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
        <script>
            // Get the value of the "count" property
            var appMatterCreate = function() {

                const form = document.getElementById('create_matter_form');
                var validations = [];

                var initCommissioning = function() {
                    $('.matter-commissioning').on('change', function() {
                        if ($(this).val() == 'committee') {

                            validations[1].addField(
                                $('.committee-input').find('select').attr('name'), {
                                    validators: {
                                        notEmpty: {
                                            message: "Committee is required."
                                        }
                                    }
                                }
                            );

                            $('.committee-input').removeClass('d-none').find('select').removeAttr(
                                'disabled').on('change', function() {
                                validations[1].revalidateField($(this).attr('name'))
                            });
                            $('.committee-input').find('input').removeAttr(
                                'disabled')

                        } else {
                            $('.committee-input').addClass('d-none').find('select').attr('disabled',
                                'disabled');
                            $('.committee-input').find('input').attr(
                                'disabled', 'disabled')
                            validations[1].removeField(
                                $('.committee-input').find('select').attr('name'));
                        }
                    });
                }

                var stepper = function() {
                    var element = document.querySelector("#kt_create_matter_stepper");
                    // Initialize Stepper
                    var stepper = new KTStepper(element);

                    // Handle next step
                    stepper.on("kt.stepper.next", function(stepper) {
                        var validator = validations[stepper.getCurrentStepIndex() - 1];

                        if (validator) {
                            validator.validate().then(function(status) {
                                if (status == "Valid") {
                                    stepper.goNext();
                                    KTUtil.scrollTop();
                                }
                            })
                        } else {
                            stepper.goNext();
                            KTUtil.scrollTop();
                        }
                        // go next step
                    });

                    // Handle previous step
                    stepper.on("kt.stepper.previous", function(stepper) {
                        // go previous step
                        var validator = validations[stepper.getCurrentStepIndex() - 1];
                        if (validator) {
                            validator.validate().then(function(status) {
                                if (status == "Valid") {
                                    stepper.goPrevious();
                                    KTUtil.scrollTop();
                                }
                            })
                        } else {
                            stepper.goPrevious();
                            KTUtil.scrollTop();
                        }
                    });
                }

                /*  var repeater = function() {
                      var el = $('#kt_matter_create_parties_repeater');

                     var repeater = el.repeater({
                         initEmpty: false,
                         repeaters: [{
                             selector: '.inner-repeater',
                             show: function() {
                                 $(this).slideDown();
                                 $(this).find('[data-control="select2"]').select2();
                                 var subRepeater = $(this).parents('.inner-repeater')
                                 if ((subRepeater.find('[data-repeater-item]')).length < 2) {
                                     subRepeater.prev('.form-label').removeClass('d-none')
                                 }

                             },
                             hide: function(deleteElement) {
                                 $(this).slideUp(deleteElement);
                                 var subRepeater = $(this).parents('.inner-repeater')
                                 if ((subRepeater.find('[data-repeater-item]')).length < 2) {
                                     subRepeater.prev('.form-label').addClass('d-none')
                                 }
                             },
                             initEmpty: true,
                         }],
                         show: function() {
                             $(this).slideDown();
                             $(this).find('[data-control="select2"]').select2();
                             $(this).before('<div class="separator separator-dashed mb-8"></div>');
                             selectPartyType();
                         },

                         hide: function(deleteElement) {
                             $(this).slideUp(deleteElement);
                             $(this).prev('.separator.separator-dashed').remove();
                             selectPartyType();
                         },
                         isFirstItemUndeletable: true
                     });
                 } */

                var initFlatPickr = function() {

                    var elements = [].slice.call(document.querySelectorAll('[data-control="flatpickr"]'));

                    elements.map(function(element) {

                        $(element).flatpickr({
                            altInput: !0,
                            altFormat: "d F, Y",
                            dateFormat: "Y-m-d"
                        });

                    });
                }

                var initValidator = function() {

                    console.log(form)

                    //Step 1 validtions rules
                    validations.push(
                        FormValidation.formValidation(form, {
                            fields: {
                                receive_date: {
                                    validators: {
                                        notEmpty: {
                                            message: "Receive Date is required."
                                        },
                                        date: {
                                            format: "YYYY-MM-DD",
                                            message: "Receive Date must follows format YYYY-MM-DD.",
                                        }
                                    }
                                },
                                number: {
                                    validators: {
                                        notEmpty: {
                                            message: "Matter Number is required.",
                                        }
                                    }
                                },
                                year: {
                                    validators: {
                                        notEmpty: {
                                            message: "Matter Year is required."
                                        },
                                        digits: {
                                            message: "Matter Year just accepts digits."
                                        },
                                        stringLength: {
                                            min: 4,
                                            max: 4,
                                            message: "Matter Year must follow format YYYY with length 4.",
                                        }
                                    }
                                },
                                court_id: {
                                    validators: {
                                        notEmpty: {
                                            message: "Court is required.",
                                        }
                                    }
                                },
                                type_id: {
                                    validators: {
                                        notEmpty: {
                                            message: "Type is required.",
                                        }
                                    }
                                },
                                next_session_date: {
                                    validators: {
                                        notEmpty: {
                                            message: "Next Session Date is required."
                                        },
                                        date: {
                                            format: "YYYY-MM-DD",
                                            message: "Next Session Date must follows format YYYY-MM-DD.",
                                        }
                                    }
                                },
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap: new FormValidation.plugins.Bootstrap5({
                                    rowSelector: '.fv-row',
                                    eleInvalidClass: '',
                                    eleValidClass: ''
                                }),
                                icon: new FormValidation.plugins.Icon({
                                    valid: 'fa fa-check me-4',
                                    invalid: 'fa fa-times me-4',
                                    validating: 'fa fa-refresh me-4',
                                }),
                                declarative: new FormValidation.plugins.Declarative({
                                    html5Input: true,
                                }),
                            }
                        })
                    )

                    //Step 2 validtions rules
                    validations.push(
                        FormValidation.formValidation(form, {
                            fields: {
                                expert_id: {
                                    validators: {
                                        notEmpty: {
                                            message: "Expert is required."
                                        }
                                    }
                                },

                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap: new FormValidation.plugins.Bootstrap5({
                                    rowSelector: '.fv-row',
                                    eleInvalidClass: '',
                                    eleValidClass: ''
                                }),
                                icon: new FormValidation.plugins.Icon({
                                    valid: 'fa fa-check me-2',
                                    invalid: 'fa fa-times me-2',
                                    validating: 'fa fa-refresh me-2',
                                }),
                                declarative: new FormValidation.plugins.Declarative({
                                    html5Input: true,
                                }),
                            }
                        })
                    );

                }

                return {
                    init: function() {
                        stepper();
                        //repeater();
                        initFlatPickr();
                        initValidator();
                        initCommissioning();
                        console.log(validations)
                    }
                }
            }();
            // Stepper lement
            appMatterCreate.init();
            // emit livewire when party type changed
        </script>
    @endpush
@endsection
