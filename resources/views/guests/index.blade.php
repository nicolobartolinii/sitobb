{{-- resources/views/guests/index.blade.php --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Elenco ospiti</title>
    <link rel="stylesheet" href="{{ asset('css/guests/index.css') }}">
{{--    <link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">--}}
</head>

<body>

    @if(Auth::check())
    @include('layouts/_navstaff')
    @endif

    <div class="container">

        <h1>Elenco ospiti</h1>

        <table class="custom-table">
            <thead>
                <tr>
                    <th>Azioni</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Nazionalità</th>
                    <th>Numero documento</th>
                    <th>Comune di residenza</th>
                    <th>Provincia</th>
                    <th>Codice postale</th>
                    <th>Indirizzo</th>
                    <th>Codice fiscale</th>
                    <th>Partita IVA</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($guests as $guest)
                    <tr>
                        <td class="actions">
                            <div class="btn-group">
                                <a class="action-btn edit" href="{{ route('guests.edit', $guest) }}">Modifica</a>
                                {!! Form::open(['route' => ['guests.destroy', $guest], 'method' => 'DELETE', 'class' => 'inline-form']) !!}
                                <button class="action-btn delete" type="submit" onclick="return confirm('Sei sicuro di voler eliminare questo ospite?')">Elimina</button>
                                {!! Form::close() !!}
                                <a href="{{ route('reservations.create', ['guest_id' => $guest->guest_id]) }}">Crea Prenotazione</a>
                            </div>
                        </td>
                        <td>{{ $guest->first_name }}</td>
                        <td>{{ $guest->last_name }}</td>
                        <td>{{ $guest->email_address ?? 'N/A' }}</td>
                        <td>{{ $guest->phone_number ?? 'N/A' }}</td>
                        <td>{{ $guest->nationality ?? 'N/A' }}</td>
                        <td>{{ $guest->document_number ?? 'N/A' }}</td>
                        <td>{{ $guest->city ?? 'N/A' }}</td>
                        <td>{{ $guest->state ?? 'N/A' }}</td>
                        <td>{{ $guest->zip_code ?? 'N/A' }}</td>
                        <td>{{ $guest->address ?? 'N/A' }}</td>
                        <td>{{ $guest->tax_id ?? 'N/A' }}</td>
                        <td>{{ $guest->vat_number ?? 'N/A' }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>


        <div class="spazio">
            {{ $guests->links('pagination.paginator') }}
        </div>

        <a href="{{ route('guests.create') }}" class="action-btn edit">Inserisci un nuovo opsite</a>
        <a href="{{ route('form') }}" class="action-btn edit">Conteggio Presenze Ospiti</a>


    </div>

    <h1>Cerca ospite per nome e/o cognome e/o numero di telefono</h1>
    <div class="search-container">
        <form action="{{ route('guests.index') }}" method="GET" style="margin-bottom: 20px;">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" placeholder="Nome" class="form-control">
            </div>
            <div class="form-group">
                <label for="surname">Cognome:</label>
                <input type="text" id="surname" name="surname" placeholder="Cognome" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone">Telefono:</label>
                <input type="text" id="phone" name="phone" placeholder="Telefono" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Cerca Ospiti</button>
        </form>
    </div>


</body>
</html>


<!-- Add this somewhere in your <body> -->

