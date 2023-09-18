{{-- resources/views/rooms/create.blade.php --}}



@section('content')
    <h1>Crea Nuova Stanza</h1>

    <form action="{{ route('rooms.store') }}" method="post">
        @csrf

        <label>Nome:
            <input type="text" name="name" required>
        </label>

        <label>Capacità:
            <input type="number" name="capacity" required>
        </label>

        <button type="submit">Salva</button>
    </form>
@endsection
