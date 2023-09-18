{{-- resources/views/reservations/show.blade.php --}}


<h1>Dettagli Prenotazione</h1>
<p>ID Prenotazione: {{ $reservation->id }}</p>
<p>Ospite: {{ $reservation->guest_id }}</p>
<p>Stanza: {{ $reservation->room_id }}</p>
<p>Data Arrivo: {{ $reservation->arrival_date->format('d-m-Y') }}</p>
<p>Data Partenza: {{ $reservation->departure_date->format('d-m-Y') }}</p>
<p>Numero Persone: {{ $reservation->number_of_guests }}</p>
<p>Numero Persone Under 14: {{ $reservation->under_14 }}</p>
<p>Importo a notte: €{{ number_format($reservation->amount_per_night, 2, ',', '.') }}</p>

<a href="{{ route('reservations.edit', $reservation) }}">Modifica</a>

<form action="{{ route('reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa prenotazione?');">
    @csrf
    @method('DELETE')
    <button type="submit" style="background-color: red; color: white;">Elimina</button>
</form>


