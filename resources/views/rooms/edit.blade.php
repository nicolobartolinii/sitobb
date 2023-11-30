{{-- resources/views/rooms/edit.blade.php --}}
<link rel="stylesheet" href="{{ asset('css/style2.css') }}">
@if(Auth::check())
    @include('layouts/_navstaff')
    @endif

    <h1>Modifica Stanza: {{ $room->name }}</h1>

    <form action="{{ route('rooms.update', $room) }}" method="post">
        @csrf
        @method('PUT')

        <label>Nome:
            <input type="text" name="name" value="{{ $room->name }}" required>
        </label>

        <label>Capacità:
            <input type="number" name="capacity" value="{{ $room->capacity }}" required>
        </label>

        <button type="submit">Aggiorna</button>
    </form>

