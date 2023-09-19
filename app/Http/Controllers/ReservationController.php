<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Guest;
use App\Models\Room;


class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations.index', ['reservations' => $reservations]);
    }

    public function create()
    {
        $rooms = Room::all();
        $guests = Guest::all();
        return view('reservations.create', ['rooms' => $rooms, 'guests' => $guests]);
    }

    public function store(Request $request)
    {
        // Qui potresti voler validare i dati della richiesta
        $reservation = Reservation::create($request->all());
        return redirect()->route('reservations.show', $reservation);
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', ['reservation' => $reservation]);
    }

    public function edit(Reservation $reservation)
    {
        $rooms = Room::all();
        $guests = Guest::all();
        return view('reservations.edit', ['reservation' => $reservation, 'rooms' => $rooms, 'guests' => $guests]);
    }

    public function update(Request $request, Reservation $reservation)
    {
        // Qui potresti voler validare i dati della richiesta
        $reservation->update($request->all());
        return redirect()->route('reservations.show', $reservation);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index');
    }


//    public function getReservationsForCalendar() {
//        $reservations = Reservation::all();
//        $events = [];
//
//        foreach($reservations as $reservation) {
//            $color = 'red'; // default color
//
//            // per colorare ma non ci riesco
//            if($reservation->room_id == 1) {
//                $color = 'blue';
//            }
//
//            $events[] = [
//                'title' => "Prenotato",
//                'start' => $reservation->arrival_date,
//                'end' => $reservation->departure_date,
//                'color' => $color,
//            ];
//        }
//
//        return response()->json($events);
//    }
    public function getReservationsForCalendar() {
        return response()->json(['message' => 'Questa è una risposta di test']);
    }

    public function showEventsInHtml() {
        $reservations = Reservation::all();
        $events = [];

        foreach($reservations as $reservation) {
            $color = 'red'; // default color
            if($reservation->room_id == 1) {
                $color = 'blue';
            }

            $events[] = [
                'title' => "Prenotato",
                'start' => $reservation->arrival_date,
                'end' => $reservation->departure_date,
                'color' => $color,
            ];
        }

        return redirect()->route('reservations.events', ['events' => $events]);
    }



}
