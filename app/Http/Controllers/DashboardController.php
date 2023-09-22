<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Conta del numero totale di ospiti, stanze e prenotazioni
        $guestCount = Guest::count();
        $roomCount = Room::count();
        $reservationCount = Reservation::count();

        // Ottiene l'ultimo ospite, stanza e prenotazione inseriti
        $latestGuest = Guest::orderBy('guest_id', 'desc')->first();
        $latestRoom = Room::orderBy('room_id', 'desc')->first();
        $latestReservation = Reservation::orderBy('id', 'desc')->first();

        // Restituisce la vista con le variabili
        return view('dashboard', [
            'guestCount' => $guestCount,
            'roomCount' => $roomCount,
            'reservationCount' => $reservationCount,
            'latestGuest' => $latestGuest,
            'latestRoom' => $latestRoom,
            'latestReservation' => $latestReservation,
        ]);
    }
}
