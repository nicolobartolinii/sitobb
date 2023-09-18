<?php

namespace App\Http\Controllers;

class userController extends Controller {
// non ha funzione costruttrice ma ha solo una funzione index che propone la vista user, sta di fatto che solo l'utente user può accedere a quella vista
// in questo caso il proceosso di autenticazione sta nella rotta(nell''admin sta nell admin controller))
    public function index() {
        return view('user');
    }

}
