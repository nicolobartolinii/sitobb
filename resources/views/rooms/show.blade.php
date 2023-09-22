{{-- resources/views/rooms/show.blade.php --}}

@if(Auth::check())
    @include('layouts/_navstaff')
    @endif

    <h1>Dettagli Stanza: {{ $room->name }}</h1>
    <p>Capacità: {{ $room->capacity }}</p>
    <a href="{{ route('rooms.edit', $room) }}">Modifica</a>
