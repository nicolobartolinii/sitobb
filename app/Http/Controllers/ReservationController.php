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
}
