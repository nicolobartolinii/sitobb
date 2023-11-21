<!-- CSS di Bootstrap -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- JS e jQuery di Bootstrap (opzionali, ma utili per alcune funzionalità) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Brand</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href={{ route('guests.index') }}>Gestione ospiti</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href={{ route('rooms.index') }}>Gestione stanze</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href={{ route('reservations.index') }}>Gestione prenotazioni</a>
        </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('calendar') }}">Calendario</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('calendario_stanza') }}">Calendario Stanza</a>
          </li>

          <li class="nav-item">
              <a class="nav-link" href="{{ route('calendari') }}">Calendari</a>
          </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        @auth
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>
        @endauth
      </ul>
    </div>
  </nav>
