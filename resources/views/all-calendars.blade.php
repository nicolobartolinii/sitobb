<!DOCTYPE html>
@if(Auth::check())
    @include('layouts/_navstaff')
@endif
<html>
<head>
    <meta charset="UTF-8">
    <title>Calendari Prenotazioni per tutte le Stanze</title>
    <link rel="stylesheet" href="https://cdn.skypack.dev/@fullcalendar/core@6.1.8/main.css">
    <link rel="stylesheet" href="https://cdn.skypack.dev/@fullcalendar/daygrid@6.1.8/main.css">
    <script type='importmap'>
    {
        "imports": {
            "@fullcalendar/core": "https://cdn.skypack.dev/@fullcalendar/core@6.1.8",
            "@fullcalendar/daygrid": "https://cdn.skypack.dev/@fullcalendar/daygrid@6.1.8"
        }
    }
    </script>

    <style>
        .calendar-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .calendar-item {
            flex: 0 0 calc(50% - 10px);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Calendari Prenotazioni per tutte le Stanze</h1>
    <div class="calendar-container">
        @foreach ($rooms as $room)
            <div class="calendar-item">
                <h2>{{ $room->name }}</h2>
                <div id="calendar-{{ $room->room_id }}"></div>
            </div>
        @endforeach
    </div>
</div>

<script type='module'>
    import { Calendar } from '@fullcalendar/core';
    import dayGridPlugin from '@fullcalendar/daygrid';

    function loadEventsForRoom(calendar, roomId) {
        fetch(`./events/${roomId}`)
            .then(response => response.json())
            .then(events => {
                calendar.removeAllEvents();
                for (let event of events) {
                    calendar.addEvent(event);
                }
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        @foreach ($rooms as $room)
        const calendarEl{{ $room->room_id }} = document.getElementById('calendar-{{ $room->room_id }}');
        const calendar{{ $room->room_id }} = new Calendar(calendarEl{{ $room->room_id }}, {
            plugins: [dayGridPlugin],
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth'
            },
            firstDay: 1,
            eventClick: function(arg) {
                const event = arg.event;
                const reservationId = event.extendedProps.reservation_id;
                window.location.href = `./reservations/${reservationId}`;
            }
        });
        calendar{{ $room->room_id }}.render();
        loadEventsForRoom(calendar{{ $room->room_id }}, {{ $room->room_id }});
        @endforeach
    });

</script>
</body>
</html>
