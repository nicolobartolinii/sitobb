{{-- resources/views/guests/index.blade.php --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Elenco ospiti</title>
    <link rel="stylesheet" href="{{ asset('css/guests/index.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

    <div class="container">

        <h1>Elenco ospiti</h1>
    
        <table>
            <thead>
                <tr>
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
    
        <a href="{{ route('guests.create') }}">Inserisci un nuovo opsite</a>
    
    </div>

</body>
</html>