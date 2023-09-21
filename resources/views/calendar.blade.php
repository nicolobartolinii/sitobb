<!DOCTYPE html>
<html>
<head>
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

        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                events: './events',


            eventClick: function(arg) {
                const event = arg.event;
                const reservationId = event.extendedProps.reservation_id;

                // Reindirizza l'utente alla pagina dei dettagli dell'evento
                window.location.href = `./reservations/${reservationId}`;
            }
            });
            calendar.render();
        });

    </script>



</head>
<body>
<div class="container">
    <h1>Calendario Prenotazioni</h1>
    <div id='calendar'></div>
</div>
</body>



{{--    <!DOCTYPE html>--}}
{{--<html lang="it">--}}

{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Calendario Prenotazioni</title>--}}

{{--    <!-- Stili per il calendario -->--}}
{{--    <link href='https://cdn.skypack.dev/@fullcalendar/core/main.css' rel='stylesheet' />--}}
{{--    <link href='https://cdn.skypack.dev/@fullcalendar/daygrid/main.css' rel='stylesheet' />--}}

{{--    <!-- Importazione delle librerie del calendario -->--}}
{{--    <script type='importmap'>--}}
{{--        {--}}
{{--            "imports": {--}}
{{--                "@fullcalendar/core": "https://cdn.skypack.dev/@fullcalendar/core@6.1.8",--}}
{{--                "@fullcalendar/daygrid": "https://cdn.skypack.dev/@fullcalendar/daygrid@6.1.8"--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}

{{--    <script type='module'>--}}
{{--        import { Calendar } from '@fullcalendar/core';--}}
{{--        import dayGridPlugin from '@fullcalendar/daygrid';--}}

{{--        let calendar;--}}

{{--        function loadEventsByRoom() {--}}
{{--            const roomId = document.getElementById('roomSelector').value;--}}
{{--            console.log('Selected Room:', roomId); // Debugging: dovresti vedere il cambio dell'ID stanza nella console--}}

{{--            // Questo chiederà al calendario di ri-prelevare gli eventi usando la nuova stanza--}}
{{--            calendar.refetchEvents();--}}
{{--        }--}}

{{--        document.addEventListener('DOMContentLoaded', function() {--}}
{{--            const calendarEl = document.getElementById('calendar');--}}

{{--            calendar = new Calendar(calendarEl, {--}}
{{--                plugins: [dayGridPlugin],--}}
{{--                headerToolbar: {--}}
{{--                    left: 'prev,next today',--}}
{{--                    center: 'title',--}}
{{--                    right: 'dayGridMonth'--}}
{{--                },--}}
{{--                events: function(fetchInfo, successCallback, failureCallback) {--}}
{{--                    const roomId = document.getElementById('roomSelector').value;--}}
{{--                    fetch(`./events?room_id=${roomId}`)--}}
{{--                        .then(response => response.json())--}}
{{--                        .then(successCallback)--}}
{{--                        .catch(failureCallback);--}}
{{--                },--}}
{{--                eventClick: function(arg) {--}}
{{--                    const event = arg.event;--}}
{{--                    const reservationId = event.extendedProps.reservation_id;--}}
{{--                    window.location.href = `./reservations/${reservationId}`;--}}
{{--                }--}}
{{--            });--}}

{{--            calendar.render();--}}
{{--        });--}}
{{--    </script>--}}
{{--</head>--}}

{{--<body>--}}
{{--<div class="container">--}}
{{--    <h1>Calendario Prenotazioni</h1>--}}
{{--    <div>--}}
{{--        Seleziona una stanza:--}}
{{--        <select id="roomSelector" onchange="loadEventsByRoom()">--}}
{{--            <!-- Qui dovresti popolare l'elenco delle camere dinamicamente dal server -->--}}
{{--            <option value="1">Stanza 1</option>--}}
{{--            <option value="2">Stanza 2</option>--}}
{{--            <option value="3">Stanza 3</option>--}}
{{--            <option value="4">Stanza 4</option>--}}
{{--            <!-- ... -->--}}
{{--        </select>--}}
{{--    </div>--}}
{{--    <div id='calendar'></div>--}}
{{--</div>--}}
{{--</body>--}}

{{--</html>--}}


