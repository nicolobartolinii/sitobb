{{-- resources/views/reservations/create.blade.php --}}

<h1>Nuova Prenotazione</h1>

{!! Form::open(['route' => 'reservations.store']) !!}

<div class="form-group">
    {!! Form::label('guest_id', 'Ospite') !!}
    {!! Form::select('guest_id', $guests->pluck('full_name', 'guest_id'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('room_id', 'Stanza') !!}
    {!! Form::select('room_id', $rooms->pluck('name', 'room_id'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('arrival_date', 'Data Arrivo') !!}
    {!! Form::date('arrival_date', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('departure_date', 'Data Partenza') !!}
    {!! Form::date('departure_date', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('number_of_guests', 'Numero Persone') !!}
    {!! Form::number('number_of_guests', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('under_14', 'Under 14') !!}
    {!! Form::number('under_14', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('amount_per_night', 'Importo a notte') !!}
    {!! Form::number('amount_per_night', null, ['class' => 'form-control', 'step' => '0.01']) !!}
</div>

<div class="form-group">
    {!! Form::submit('Salva', ['class' => 'btn btn-primary']) !!}
</div>

{!! Form::close() !!}
