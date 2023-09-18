
{{-- resources/views/reservations/index.blade.php --}}

    <h1>Elenco Prenotazioni</h1>
    <a href="{{ route('reservations.create') }}">Nuova Prenotazione</a>
    <ul>
        @foreach ($reservations as $reservation)
            <li>
                Prenotazione per {{ $reservation->guest_id }} dal {{ $reservation->arrival_date }} al {{ $reservation->departure_date }}
                <a href="{{ route('reservations.show', $reservation) }}">Dettagli</a>
                <a href="{{ route('reservations.edit', $reservation) }}">Modifica</a>
            </li>
        @endforeach
    </ul>

