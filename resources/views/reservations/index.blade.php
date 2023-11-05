
{{-- resources/views/reservations/index.blade.php --}}
<link rel="stylesheet" href="{{ asset('css/style2.css') }}">
@if(Auth::check())
    @include('layouts/_navstaff')
    @endif

<h1>Elenco Prenotazioni</h1>
<a href="{{ route('reservations.create') }}">Nuova Prenotazione</a>
<ul>
    @foreach ($reservations as $reservation)
        <li>
            Prenotazione per {{ $reservation->guest->first_name }} {{ $reservation->guest->last_name }}
            per {{ $reservation->number_of_guests }} persone
            dal {{ $reservation->arrival_date->format('d/m/Y') }}
            al {{ $reservation->departure_date->format('d/m/Y') }}
            - Totale: €{{ $reservation->amount_per_night * $reservation->departure_date->diffInDays($reservation->arrival_date) }}
            <a href="{{ route('reservations.show', $reservation) }}">Dettagli</a>
            <a href="{{ route('reservations.edit', $reservation) }}">Modifica</a>
        </li>
    @endforeach
</ul>

<form action="{{ route('reservations.index') }}" method="GET">
    <div class="form-group">
        <label for="first_name">Nome:</label>
        <input type="text" id="first_name" name="first_name">
    </div>
    <div class="form-group">
        <label for="last_name">Cognome:</label>
        <input type="text" id="last_name" name="last_name">
    </div>
    <div class="form-group">
        <label for="start_date">Data Inizio:</label>
        <input type="date" id="start_date" name="start_date" >
    </div>
    <div class="form-group">
        <label for="end_date">Data Fine:</label>
        <input type="date" id="end_date" name="end_date" >
    </div>
    <button type="submit">Cerca Prenotazioni</button>
</form>

