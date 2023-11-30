<!-- resources/views/guests/form.blade.php -->
<link rel="stylesheet" href="{{ asset('css/style2.css') }}">
@if(Auth::check())
@include('layouts/_navstaff')
@endif

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Conteggio Ospiti</title>

</head>
<body>

<div class="container">
    <h1>Conteggio Ospiti</h1>

    <form action="{{ route('count') }}" method="GET">
        <div class="form-group">
            <label for="start_date">Data Inizio:</label>
            <input type="date" id="start_date" name="start_date" >
        </div>
        <div class="form-group">
            <label for="end_date">Data Fine:</label>
            <input type="date" id="end_date" name="end_date" >
        </div>
        <button type="submit">Calcola Presenze</button>
    </form>

    @if(isset($totalPresences))
        <p>Dal {{ $startDate }} al {{ $endDate }}, ci sono state in pernottamento {{ $totalPresences }} presenze di ospiti sopra i 14 anni.</p>
    @endif

</div>

</body>
</html>
