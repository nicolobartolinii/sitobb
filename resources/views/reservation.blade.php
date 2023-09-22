
@if(Auth::check())
    @include('layouts/_navstaff')
    @endif

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

... // Puoi continuare con gli altri campi in modo simile

<div class="form-group">
    {!! Form::submit('Add Guest', ['class' => 'btn btn-primary']) !!}
</div>

{!! Form::close() !!}
