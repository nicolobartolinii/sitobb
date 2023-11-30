{{-- resources/views/reservations/index.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <title>Elenco Prenotazioni</title>
</head>
<body>
@if(Auth::check())
    @include('layouts/_navstaff')
@endif




<div class="grid grid--center">
    <!-- Header -->
    <div class="col col-100 sma-100">
        <h1>Elenco Prenotazioni</h1>
        <a href="{{ route('reservations.create') }}" class="btn">Nuova Prenotazione</a>
    </div>

    <div class="col col-100 sma-100">
        @if(count($reservations) > 0)
            <table class="table table-hover table-responsive">
                <thead class="thead-dark">
                <tr>
                    <th>Nome Ospite</th>
                    <th>Data Arrivo</th>
                    <th>Data Partenza</th>
                    <th>Camera</th>
                    <th>Numero di telefono</th>
                    <!-- Altri campi se necessario -->
                </tr>
                </thead>
                <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}</td>
                        <td>{{ $reservation->arrival_date }}</td>
                        <td>{{ $reservation->departure_date }}</td>
                        <td>{{ $reservation->room->name }}</td>
                        <td>{{ $reservation->guest->phone_number }}</td>
                        <!-- Altri campi se necessario -->
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Nessuna prenotazione trovata per i criteri specificati.</p>
        @endif
    </div>
</div>


<!-- Form di Ricerca -->
    <div class="col col-100 sma-100">
        <h1>Ricerca prenotazione</h1>
        <form action="{{ route('reservations.index') }}" method="GET" class="form-group">
            <label for="first_name">Nome:</label>
            <input type="text" id="first_name" name="first_name" class="input-field">

            <label for="last_name">Cognome:</label>
            <input type="text" id="last_name" name="last_name" class="input-field">

            <label for="start_date">Data Inizio:</label>
            <input type="date" id="start_date" name="start_date" class="input-field">

            <label for="end_date">Data Fine:</label>
            <input type="date" id="end_date" name="end_date" class="input-field">

            <button type="submit" class="btn">Cerca Prenotazioni</button>
        </form>
    </div>

    <!-- Tabella Prenotazioni -->

</body>
</html>
