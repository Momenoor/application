@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                {{ __('app.vacations-list') }}
            </div>
        </div>
        <div class="card-body">
            <div id="vacation_calendar"></div>
        </div>
    </div>
@endsection
@push('scripts')
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <script>
        var initialLocaleCode = "{{ app()->getLocale() }}";
        var calendarEl = document.getElementById("vacation_calendar");
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
            },

            aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio

            nowIndicator: true,

            height: 800,
            contentHeight: 780,

            locale: initialLocaleCode,

            initialView: "dayGridMonth",
            initialDate: "{{ now() }}",

            dayMaxEvents: true, // allow "more" link when too many events
            navLinks: true,
            eventSources: [

                // your event source
                {
                    url: '{{ route('events') }}',
                    method: 'POST',
                    extraParams: {
                        model: '\\App\\Models\\Vacation',
                    },
                    failure: function() {
                        alert('there was an error while fetching events!');
                    },

                }

                // any other sources...

            ],

            eventContent: function(info) {
                var element = $(info.el);

                if (info.event.extendedProps && info.event.extendedProps.description) {
                    if (element.hasClass("fc-day-grid-event")) {
                        element.data("content", info.event.extendedProps.description);
                        element.data("placement", "top");
                        KTApp.initPopover(element);
                    } else if (element.hasClass("fc-time-grid-event")) {
                        element.find(".fc-title").append("<div class='fc-description'>" + info.event
                            .extendedProps.description + "</div>");
                    } else if (element.find(".fc-list-item-title").lenght !== 0) {
                        element.find(".fc-list-item-title").append("<div class='fc-description'>" + info.event
                            .extendedProps.description + "</div>");
                    }
                }
            }

        });

        calendar.render();
        console.log(calendar);
    </script>
@endpush
