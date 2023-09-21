<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B&B Il Gelso Nero</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 100px;
        }
        h1 {
            color: #2c3e50;
        }
    </style>
</head>

<body>

<h1>Ciao a tutti!</h1>
<p>Benvenuti al sito del B&B Il Gelso Nero.</p>
<h1>Pagina home </h1>
<li><a href="{{ route('login') }}" class="highlight" title="Accedi all'area riservata del sito">Login</a></li>
<li><a href="" class="highlight" title="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
</body>

</html>
