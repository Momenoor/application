@extends('layouts.app')
@section('content')
    <div class="">
        @include('pages.matters.form.partials._show_header')
        @include('pages.matters.form.partials._show_main_data')
        <div class="row">

            <div class="col-lg-7 col-md-12">
                <!--begin::Card-->
                <div class="mb-5">
                    @include('pages.matters.form.partials._show_claims')
                    @include(
                        'pages.cashes._collection_modal'
                    )
                </div>
                <div class="mb-5">
                    @include('pages.matters.form.partials._show_parties')
                </div>
                @if ($matter->attachments()->exists())
                    <div class="mb-5">
                        @include(
                            'pages.matters.form.partials._show_attachment'
                        )
                    </div>
                @endif
                <!--end::Card-->
            </div>
            <div class="col-lg-5 col-md-12">
                <!--begin::Card-->
                <div class="mb-5">
                    @include(
                        'pages.matters.form.partials._show_activities'
                    )
                </div>
                <div class="mb-5">
                    @livewire(
                    'create-matter-note',['matter'=>$matter]
                    )
                </div>
                <!--end::Card-->
            </div>
        </div>
        <!--end::Col-->
        <!--end::Col-->

    </div>
    {{-- Inject Scripts --}}
@endsection
@push('style')
    <style>
        .tree,
        .tree ul {
            margin: 0;
            padding: 0;
            list-style: none
        }

        .tree ul {
            margin-left: 1em;
            position: relative
        }

        .tree ul ul {
            margin-left: .5em
        }

        .tree ul:before {
            content: "";
            display: block;
            width: 0;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            border-left: 1px solid
        }

        .tree li {
            margin: 0;
            padding: 0 1em;
            line-height: 2em;
            color: #369;
            font-weight: 700;
            position: relative
        }

        .tree ul li:before {
            content: "";
            display: block;
            width: 3.75rem;
            height: 0;
            border-top: 1px solid;
            margin-top: -1px;
            position: absolute;
            top: 1em;
            left: 0
        }

        .tree ul li:last-child:before {
            background: #fff;
            height: auto;
            top: 1em;
            bottom: 0
        }

        .indicator {
            margin-right: 5px;
        }

        .tree li a {
            text-decoration: none;
            color: #369;
        }

        .tree li button,
        .tree li button:active,
        .tree li button:focus {
            text-decoration: none;
            color: #369;
            border: none;
            background: transparent;
            margin: 0px 0px 0px 0px;
            padding: 0px 0px 0px 0px;
            outline: 0;
        }

    </style>
@endpush
@push('scripts')
    <script>
        window.addEventListener('swal:modal', event => {
            swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
            });
        });
        window.addEventListener('swal:confirm', event => {
            swal.fire({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type,
                    showCancelButton: true,
                    reverseButtons: true
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit(event.detail.callback, event.detail.id);
                    }
                });
        });
    </script>

    @if ($errors->hasAny(['procedure.datetime', 'procedure.description']))
        <script>
            new bootstrap.Modal($('#addNextSessionDateModal')).show();
        </script>
    @endif

    @if ($errors->hasAny(['claim.amount', 'claim.type', 'claim.recurring']))
        <script>
            new bootstrap.Modal($('#addClaimModal')).show();
        </script>
    @endif

    @if ($errors->hasAny(['party.type', 'party.name', 'party.phone', 'party.email']))
        <script>
            new bootstrap.Modal($('#addPartyModal')).show();
        </script>
    @endif
    @if ($errors->hasAny(['party.id', 'party.subparty']))
        <script>
            new bootstrap.Modal($('#addAdvocateModal')).show();
        </script>
    @endif

    @if ($errors->hasAny(['expert.assistant']))
        <script>
            new bootstrap.Modal($('#addAssistantModal')).show();
        </script>
    @endif
    @if ($errors->hasAny(['cash.amount','cash.description']))
        <script>
            new bootstrap.Modal($('#collectionModal')).show();
        </script>
    @endif

@endpush
