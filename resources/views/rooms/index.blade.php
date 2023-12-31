{{-- resources/views/rooms/index.blade.php --}}
<link rel="stylesheet" href="{{ asset('css/style2.css') }}">
@if(Auth::check())
    @include('layouts/_navstaff')
    @endif


    <h1>Lista delle Stanze</h1>
    <a href="{{ route('rooms.create') }}">Aggiungi nuova stanza</a>

    <ul>
        @foreach($rooms as $room)
            <li>
                {{ $room->name }}
                <a href="{{ route('rooms.show', $room) }}">Dettagli</a>
                <a href="{{ route('rooms.edit', $room) }}">Modifica</a>
                <form action="{{ route('rooms.destroy', $room) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Elimina</button>
                </form>
            </li>
        @endforeach
    </ul>


