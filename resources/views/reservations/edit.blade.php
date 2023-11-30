<link rel="stylesheet" href="{{ asset('css/style2.css') }}">

<h1>MODIFICA delle prenotazioni</h1>

@if(Auth::check())
@include('layouts/_navstaff')
@endif

{!! Form::model($reservation, ['route' => ['reservations.update', $reservation->id], 'method' => 'PUT']) !!}

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div>
    {!! Form::label('guest_id', 'Ospite') !!}
    {!! Form::select('guest_id', $guests->pluck('first_name', 'guest_id'), null, ['placeholder' => 'Scegli un
    ospite...', 'required' => 'required']) !!}
</div>

<div>
    {!! Form::label('room_id', 'Stanza') !!}
    {!! Form::select('room_id', $rooms->pluck('name', 'room_id'), null, ['placeholder' => 'Scegli una stanza...',
    'required' => 'required']) !!}
</div>

<div>
    {!! Form::label('arrival_date', 'Data Arrivo') !!}
    {!! Form::date('arrival_date', $reservation->arrival_date, ['required' => 'required']) !!}
</div>

<div>
    {!! Form::label('departure_date', 'Data Partenza') !!}
    {!! Form::date('departure_date', $reservation->departure_date, ['required' => 'required']) !!}
</div>

<div>
    {!! Form::label('number_of_guests', 'Numero Persone') !!}
    {!! Form::number('number_of_guests', null, ['required' => 'required']) !!}
</div>

<div>
    {!! Form::label('under_14', 'Under 14') !!}
    {!! Form::number('under_14', null, ['required' => 'required']) !!}
</div>

<div>
    {!! Form::label('amount_per_night', 'Importo a Notte') !!}
    {!! Form::number('amount_per_night', null, ['step' => '0.01', 'required' => 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('note', 'Note') !!}
    {!! Form::text('note', null) !!}
</div>
<div class="checkbox">
    {!! Form::hidden('tassa_soggiorno', 0) !!} {{-- invia 0 se la checkbox non è selezionata --}}
    {!! Form::checkbox('tassa_soggiorno', 1, null, ['id' => 'tassa_soggiorno']) !!}
    {!! Form::label('tassa_soggiorno', 'Tassa di Soggiorno') !!}
</div>
<div class="checkbox">
    {!! Form::hidden('from_booking', 0) !!} {{-- invia 0 se la checkbox non è selezionata --}}
    {!! Form::checkbox('from_booking', 1, null, ['id' => 'from_booking']) !!}
    {!! Form::label('from_booking', 'Booking') !!}
</div>
<div>
    {!! Form::submit('Aggiorna Prenotazione') !!}
</div>

{!! Form::close() !!}
