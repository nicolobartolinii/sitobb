{!! Form::model($reservation, ['route' => ['reservations.update', $reservation->id], 'method' => 'PUT']) !!}

<div>
    {!! Form::label('guest_id', 'Ospite') !!}
    {!! Form::select('guest_id', $guests->pluck('first_name', 'guest_id'), null, ['placeholder' => 'Scegli un ospite...']) !!}
</div>

<div>
    {!! Form::label('room_id', 'Stanza') !!}
    {!! Form::select('room_id', $rooms->pluck('name', 'room_id'), null, ['placeholder' => 'Scegli una stanza...']) !!}
</div>

<div>
    {!! Form::label('arrival_date', 'Data Arrivo') !!}
    {!! Form::date('arrival_date', null) !!}
</div>

<div>
    {!! Form::label('departure_date', 'Data Partenza') !!}
    {!! Form::date('departure_date', null) !!}
</div>

<div>
    {!! Form::label('number_of_guests', 'Numero Persone') !!}
    {!! Form::number('number_of_guests') !!}
</div>

<div>
    {!! Form::label('under_14', 'Under 14') !!}
    {!! Form::number('under_14') !!}
</div>

<div>
    {!! Form::label('amount_per_night', 'Importo a Notte') !!}
    {!! Form::number('amount_per_night', null, ['step' => '0.01']) !!}
</div>

<div>
    {!! Form::submit('Aggiorna Prenotazione') !!}
</div>

{!! Form::close() !!}
