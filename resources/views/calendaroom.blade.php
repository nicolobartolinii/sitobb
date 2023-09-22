<!DOCTYPE html>
@if(Auth::check())
    @include('layouts/_navstaff')
@endif
<html>
<head>
    <meta charset="UTF-8">
    <title>Calendario Prenotazioni per Stanza</title>
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
    <script type='module'>
        import { Calendar } from '@fullcalendar/core';
        import dayGridPlugin from '@fullcalendar/daygrid';

        let calendar;

        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                firstDay: 1, // per farlo partire dal lunedi
                eventClick: function(arg) {
                    const event = arg.event;
                    const reservationId = event.extendedProps.reservation_id;
                    window.location.href = `./reservations/${reservationId}`;
                }
            });
            calendar.render();
            loadEvents(1); // Carica gli eventi per la stanza di default all'inizio
        });

        function loadEvents(roomId) {
            fetch(`./events/${roomId}`)
                .then(response => response.json())
                .then(events => {
                    calendar.removeAllEvents();
                    for (let event of events) {
                        calendar.addEvent(event);
                    }
                });
        }

        window.changeRoom = function(newRoomId) {
            console.log("Changing to room:", newRoomId); // Aggiunto per il debug
            loadEvents(newRoomId);
        }

    </script>
</head>
<body>
<div class="container">
    <h1>Calendario Prenotazioni</h1>
    <select onchange="changeRoom(this.value)">
        @foreach($rooms as $room)
            <option value="{{ $room->room_id }}">{{ $room->name }}</option>
        @endforeach
    </select>
    <div id='calendar'></div>
</div>
</body>
</html>
