
    <h1>Eventi del calendario</h1>
    <ul>
        @foreach($events as $event)
            <li>
                Titolo: {{ $event['title'] }} <br>
                Inizio: {{ $event['start'] }} <br>
                Fine: {{ $event['end'] }} <br>
                Colore: <span style="color:{{ $event['color'] }}">{{ $event['color'] }}</span>
            </li>
        @endforeach
    </ul>

