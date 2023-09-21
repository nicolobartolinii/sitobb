<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GuestsController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
 * SPIEGAZIONE ROUTE RESOURCE
|Questo comando definisce le seguenti rotte:
|GET /rooms - per visualizzare un elenco delle risorse (metodo index del controller).
|GET /rooms/create - mostra un modulo per creare una nuova risorsa (metodo create del controller).
|POST /rooms - salva una nuova risorsa (metodo store del controller).
|GET /rooms/{room} - mostra una singola risorsa (metodo show del controller).
|GET /rooms/{room}/edit - mostra un modulo per modificare una risorsa esistente (metodo edit del controller).
|PUT/PATCH /rooms/{room} - aggiorna una risorsa esistente (metodo update del controller).
|DELETE /rooms/{room} - elimina una risorsa (metodo destroy del controller).
|
*/

Route::view('/ciao', 'ciao');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::resource('rooms', RoomController::class);
Route::resource('guests', GuestsController::class);

Route::resource('reservations', ReservationController::class);



Route::get('/calendar', function () {
    return view('calendar');
});
Route::get('/events', [ReservationController::class, 'getReservationsForCalendar']);



Route::get('/show-events', [ReservationController::class, 'showEventsInHtml']);

Route::get('/test', function() {
    return 'Questa è una pagina di test';
});
