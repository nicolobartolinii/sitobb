<link rel="stylesheet" href="{{ asset('css/style2.css') }}">



@if(Auth::check())
@include('layouts/_navstaff')
@endif

{!! Form::model($reservation, ['route' => ['reservations.update', $reservation->id], 'method' => 'PUT']) !!}
<h1>MODIFICA delle prenotazioni</h1>
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
    {!! Form::date('arrival_date', null, ['required' => 'required']) !!}
</div>

<div>
    {!! Form::label('departure_date', 'Data Partenza') !!}
    {!! Form::date('departure_date', null, ['required' => 'required']) !!}
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
<div>
    {!! Form::submit('Aggiorna Prenotazione') !!}
</div>

{!! Form::close() !!}
