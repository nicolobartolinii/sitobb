<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

    <div class="dashboard-container">

        <a href="./guests" class="dashboard-block">
            <h2>Gestione ospiti</h2>
        </a>

        <a href="./rooms" class="dashboard-block">
            <h2>Gestione stanze</h2>
        </a>

        <a href="./reservations" class="dashboard-block">
            <h2>Gestione prenotazioni</h2>
        </a>

        <a href="./calendar" class="dashboard-block">
            <h2>Calendario prenotazioni</h2>
        </a>

    </div>

</body>
</html>
