<ul>
    <li><a href="{{ route('catalog1') }}" title="Home">Catalogo</a></li>
    <li><a href="{{ route('who') }}" title="Il nostro profilo aziendale">Chi siamo</a></li>
    <li><a href="{{ route('where') }}" title="Dove trovarci">Dove Siamo</a></li>
    <li><a href="mailto:info@acme.it" title="Mandaci un messaggio">Contattaci</a></li>

{{--utilizzo un metodo di gate,si gestisce tutto dalla pagina di navbar, ha sempre visualizzato catalogo dove siamo e contattaci
avrà poi una sezione can is admin, cioè se questa vista viene attivata si attiva home admin, se invece è registato come user
apparirà il link per homeuser,
--}}

    @can('isAdmin')
        <li><a href="{{ route('admin') }}" class="highlight" title="Home Admin">Home Admin</a></li>
    @endcan

    @can('isUser')
        <li><a href="{{ route('user') }}" class="highlight" title="Home User">Home User</a></li>
    @endcan

{{--    questo if risulta vero se c'è un utente autenticato al sito, indipendentemente se sia admin o utente, quindi come si fa?? si crea riferimento al logout
si fa utilizzando una modalità sicura, si utilizza il metodo post(questo dice protocollo sicurezza laravel), allora si genera una form con un
unico elemento che è la nostra ancora e attivo la form attraverso l'ancora stessa, in questo caso il metodojavascript attiva il blocco del metodo
standar per l'attivazione get per l'ancora poi attivo la form dove l'elemento della apgina id="logout-form", quindi è una form non visualizzata la quale non ha bottone submit ma viene attivata da un ancora
questo fa si che la richiesta di logout venga attivata in maniera sicura, e grazie al csrf token siamo sicuri che sia la stessa persona, nella from si seziona pubblica oltre alle 4 ancora se
utilizzano questi metodo --}}
    @auth
        <li><a href="" title="Esci dal sito" class="highlight" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    @endauth
{{--    nell'ipotesi non ci sia un utente loggato va generato a valle dell'utente loggato va generata l'acnora di login, e quindi @guest è vera se non c'è un utente
loggato all'atto della visualizzazione, e facciamo apparire la nostra ancora che attiva la rotta login e che è associata alla parola accedi e quindi utilizzando queste direttive attivo
una navbar dinamica--}}
    @guest
        <li><a href="{{ route('login') }}" class="highlight" title="Accedi all'area riservata del sito">Accedi</a></li>
    @endguest
</ul>
