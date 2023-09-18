<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// qui vengono definiti i metodi di gate, ad ogni gate va associato un nome
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
// admin per admin
        Gate::define('isAdmin', function ($user) {
            return $user->hasRole('admin');// immagine di eloquent della tupla del db, qui verifico se l'utente loggato a un ruolo dell'admin
            // discorso analogo per tutti gli altri
        });

// per utente
        Gate::define('isUser', function ($user) {
            return $user->hasRole('user');
        });
// per far vedere il prezzo dei prodotti a catalogo

        Gate::define('show-discount', function ($user) {
            return $user->hasRole(['user', 'admin']);// qui mi controlla sia se è admin sia se è user
        });
    }
}
