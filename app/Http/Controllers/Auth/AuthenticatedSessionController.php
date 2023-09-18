<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// CONTROLLER PER L'AUTENTICAZIONE
// qui va cambiata la vista dove è contenuta la form di login, dobbiamo cmabiare cosa accade alla fine del processo
// di autenticazione, al termine della
class AuthenticatedSessionController extends Controller {

    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request) {
        $request->authenticate();

        $request->session()->regenerate();

        /**
         * Redirezione su diverse Home Page in base alla classe d'utenza.
         */
//        return redirect()->intended(RouteServiceProvider::HOME);


// reindirizzamento qui ci vorrà membro senior
        // metodo che estra tutto il profilo dell'utente registrato, estraiamo dall'utente il ruolo, estraiamo il metodo auth(),
        // gestisce procedura, se ruolo è user va
        $role = auth()->user()->role;
        switch ($role) {
            case 'admin': return redirect()->route('admin');
                break;
            case 'user': return redirect()->route('user');
                break;
            default: return redirect('/');
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // qui le regole stanno in un altra pagina in loginrequest
    public function destroy(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
