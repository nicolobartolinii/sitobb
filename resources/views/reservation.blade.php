
@if(Auth::check())
    @include('layouts/_navstaff')
    @endif
<link rel="stylesheet" href="{{ asset('css/style2.css') }}">

<h1>Reservation</h1>
{!! Form::open(['route' => 'guests.store', 'method' => 'POST']) !!}

<div class="form-group">
    {!! Form::label('first_name', 'First Name') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control', 'required' => 'required', 'maxlength' => 50]) !!}
</div>

<div class="form-group">
    {!! Form::label('last_name', 'Last Name') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control', 'required' => 'required', 'maxlength' => 50]) !!}
</div>

<div class="form-group">
    {!! Form::label('email_address', 'Email Address') !!}
    {!! Form::email('email_address', null, ['class' => 'form-control', 'maxlength' => 50]) !!}
</div>

<div class="form-group">
    {!! Form::label('phone_number', 'Phone Number') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control', 'maxlength' => 50]) !!}
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




<div class="form-group">
    {!! Form::submit('Add Guest', ['class' => 'btn btn-primary']) !!}
</div>

{!! Form::close() !!}
