{{-- resources/views/guests/create.blade.php --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inserisci un nuovo opsite</title>
    <link rel="stylesheet" href="{{ asset('css/guests/edit.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

    <h1>Modifica ospite</h1>

    {!! Form::model($guest, ['route' => ['guests.update', $guest], 'method' => 'PUT', 'class' => 'form']) !!}
    @csrf
        <div>
            {!! Form::label('first_name', 'Nome:') !!}
            {!! Form::text('first_name', null, ['required']) !!}
        </div>

        <div>
            {!! Form::label('last_name', 'Cognome:') !!}
            {!! Form::text('last_name', null, ['required']) !!}
        </div>

        <div>
            {!! Form::label('email_address', 'Indirizzo email:') !!}
            {!! Form::email('email_address') !!}
        </div>

        <div>
            {!! Form::label('phone_number', 'Telefono:') !!}
            {!! Form::tel('phone_number') !!}
        </div>

        <div>
            {!! Form::label('nationality', 'Nazionalità:') !!}
            {!! Form::text('nationality') !!}
        </div>

        <div>
            {!! Form::label('document_number', 'Numero documento:') !!}
            {!! Form::text('document_number') !!}
        </div>

        <div>
            {!! Form::label('city', 'Comune di residenza:') !!}
            {!! Form::text('city') !!}
        </div>

        <div>
            {!! Form::label('state', 'Provincia:') !!}
            {!! Form::text('state') !!}
        </div>

        <div>
            {!! Form::label('zip_code', 'Codice postale:') !!}
            {!! Form::text('zip_code') !!}
        </div>

        <div>
            {!! Form::label('address', 'Indirizzo:') !!}
            {!! Form::text('address') !!}
        </div>

        <div>
            {!! Form::label('tax_id', 'Codice fiscale:') !!}
            {!! Form::text('tax_id') !!}
        </div>

        <div>
            {!! Form::label('vat_number', 'Partita IVA:') !!}
            {!! Form::text('vat_number') !!}
        </div>

        {!! Form::submit('Conferma') !!}

    {!! Form::close() !!}
</body>