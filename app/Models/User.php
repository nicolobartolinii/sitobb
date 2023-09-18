<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// uso quello di default ma lo modifico, ci metto email e psw e ci sono dei campi protetti


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // facciamo in modo che questo elemento sia propetetto dai meccanismi di invio da json(credo sql iniection), model diverso dai precedenti,
    // non è estensione classici come i modelli classici ma attenzione è un modello particolare, equivalente degli altri, ma
    protected $hidden = [
        'username',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // non devo cambiarlo, ma aggiungo un metodo hasRole, potrò attivare un metodo sul singolo utente, prende come parametro il ruolo che io gli passo
    // trasforma il paragrafo in un array e ritorna il risultato in un array, mi da la possibilità di fare un array con user e admin e ritorno il ruolo
    // con verifica se è vero o no, cosi verifico il ruolo che un utente gli appartiene, costruisco cosi un gate, che restituisce true o false, in base al parametro che gli passo
    //LA HAS ROLE GLI PASSO UN RUOLO E MI RITORNA TRUE E FALSE IN BASE AL RUOLO CHE HA L'UTENTE
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


// funzione has role serve per i gate
    public function hasRole($role) {
        $role = (array)$role;
        return in_array($this->role, $role);
    }

}
