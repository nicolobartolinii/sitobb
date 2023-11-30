<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GuestsController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CalendarController;

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

Route::view('/home', 'home')->name('home');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware('can:isStaff')
    ->name('dashboard');


Route::resource('rooms', RoomController::class)->middleware('can:isStaff');
Route::resource('guests', GuestsController::class)->middleware('can:isStaff');

Route::get('/reservations/create/{guest_id?}', [ReservationController::class, 'create'])->name('reservations.create');

Route::resource('reservations', ReservationController::class)->middleware('can:isStaff');
//Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');



Route::get('/calendar', function () {
    return view('calendar');
})->middleware('can:isStaff');

// rotta di prova per il calendario
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar')->middleware('can:isStaff');
// rotta per avere le camere dinamicamente nelle opzioni del calendario
//Route::get('/rooms', [ReservationController::class, 'getAllRooms']);
Route::get('/roomscalendar', [RoomController::class, 'listRooms'])->name("calendario_stanza")->middleware('can:isStaff');;
Route::get('/events/{roomId}', [ReservationController::class, 'getReservationsByRoom'])->middleware('can:isStaff');




// rotta per avere tutti i calendari in un unica vista
Route::get('/all-calendars', [RoomController::class, 'showAllCalendars'])->name("calendari")->middleware('can:isStaff');;
Route::get('/events', [ReservationController::class, 'getReservationsForCalendar'])->middleware('can:isStaff');
// rotta per avere i file json da utilizzare per ogni camera



Route::get('/show-events', [ReservationController::class, 'showEventsInHtml'])->middleware('can:isStaff');

Route::get('/test', function() {
    return 'Questa è una pagina di test';
});
// Questa rotta mostra la form all'utente
Route::get('/form',[ GuestsController::class, 'showForm'])->name('form');

// Questa rotta gestisce i dati inviati dalla form
Route::get('/count', [GuestsController::class, 'countGuests'])->name('count');



require __DIR__.'/auth.php';
