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
                events: '/sitobb/public/events'
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
</html>