<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    @if(Auth::check())
    @include('layouts/_navstaff')
    @endif

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="dashboard-block">
                    <h1>Info ospiti</h1>
                    <p>Numero ospiti registrati: {{ $guestCount }}</p>
                    <p>Ultimo ospite registrato: {{ ($latestGuest->first_name ?? 'Nessuno').(" ".$latestGuest->last_name
                        ??
                        "") }}</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="dashboard-block">
                    <h1>Info stanze</h1>
                    <p>Numero stanze registrate: {{ $roomCount }}</p>
                    <p>Ultima stanza registrata: {{ $latestRoom->name ?? 'Nessuna' }}</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="dashboard-block">
                    <h1>Info prenotazioni</h1>
                    <p>Numero prenotazioni registrate: {{ $reservationCount }}</p>
                    <p>Ultima prenotazione registrata: {{ $latestReservation->id ?? 'Nessuna' }}</p>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>