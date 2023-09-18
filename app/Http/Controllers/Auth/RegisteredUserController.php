<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

// create e store sono 2 metodi che su auth.php sono due metodi che vengono attivate le rotte che vengono attivate tramite la rotta di autenticazione
// vanno quindi modificati per quelli che ci servono, per create non si cambia nulla

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    // per questa va cambiato qualcosa come campo nome e congome, non c'è ruolo che viene assegnato direttamente dal model
    // (tutti user per i nuovi utenti)
    //
    public function store(Request $request)
    {
        // vado a specificare le regole di validazione, lo username deve essere unico  e di minimo di 8 caratteri,
        // con questo vincolo garantisco l'unicità per essere sicuro che esistano 2 utenti con lo stesso username
        // di conseguenza avrò due elementi univoci
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'min:8', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
// la modifico per associare alle componenti dell'oggetto che sto creando gli elementi che vengono dalla form, e l'unificazione del contenuto
// utilizzo il request object( cosa conteneva il messaggio che il client ha inviato al server.
// aggiungo l'unificazione dei campi
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),// gestione interssante perchè viene cifrato tramite hash
        ]);

        event(new Registered($user));// creata tupla e poi viene eseguito il login, poi si reindirizza l'utente nella homepage nella pagina catalogo

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);// attenzione perchè breeze mette come homepage la dashboard, e quindi va rimesso cosa è la home
        //dove viene definita la propietà home?? tasto destro e go to the declaration
    }
}
