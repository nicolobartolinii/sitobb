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

        $request->validate([
            'guest_id' => 'required|exists:guests,guest_id',
            'arrival_date' => 'required|date|date_format:Y-m-d|after_or_equal:today|before_or_equal:2100-12-31',
            'departure_date' => 'required|date|date_format:Y-m-d|after:arrival_date|before_or_equal:2100-12-31',

            'room_id' => ['required', function ($attribute, $value, $fail) use ($request) {
                $exists = Reservation::where('room_id', $value)
                    ->where('arrival_date', '<=', $request->departure_date)
                    ->where('departure_date', '>=', $request->arrival_date)
                    ->exists();

                if ($exists) {
                    $fail('La stanza è già prenotata nelle date selezionate.');
                }
            }],
            'number_of_guests' => ['required', 'integer', function ($attribute, $value, $fail) use ($request) {
                $room = Room::find($request->room_id);
                if ($room && $value > $room->capacity) {
                    $fail('Il numero di persone supera la capacità della stanza.');
                }
            }],
            'under_14' => 'required|integer|min:0',
            'amount_per_night' => 'required|numeric|min:10',
        ]);

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
        $request->validate([
            'guest_id' => 'required|exists:guests,guest_id',
            'arrival_date' => 'required|date|date_format:Y-m-d|after_or_equal:today|before_or_equal:2100-12-31',
            'departure_date' => 'required|date|date_format:Y-m-d|after:arrival_date|before_or_equal:2100-12-31',
            'room_id' => ['required', function ($attribute, $value, $fail) use ($request, $reservation) {
                $exists = Reservation::where('room_id', $value)
                    ->where('id', '!=', $reservation->id) // Escludo  la prenotazione corrente
                    ->where('arrival_date', '<=', $request->departure_date)
                    ->where('departure_date', '>=', $request->arrival_date)
                    ->exists();

                if ($exists) {
                    $fail('La stanza è già prenotata nelle date selezionate.');
                }
            }],
            'number_of_guests' => ['required', 'integer', function ($attribute, $value, $fail) use ($request) {
                $room = Room::find($request->room_id);
                if ($room && $value > $room->capacity) {
                    $fail('Il numero di persone supera la capacità della stanza.');
                }
            }],
            'under_14' => 'required|integer|min:0',
            'amount_per_night' => 'required|numeric|min:10',
        ]);

        $reservation->update($request->all());

        return redirect()->route('reservations.show', $reservation);
    }


    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index');
    }


    public function getReservationsForCalendar() {
        $reservations = Reservation::all();
        $events = [];

        foreach($reservations as $reservation) {
            $color = 'red'; // default color

            // per colorare ma non ci riesco
            if($reservation->room_id == 1) {
                $color = 'blue';
            }
            if($reservation->room_id == 2) {
                $color = 'green';
            }

            $events[] = [
                'title' => "Prenotato da: " . $reservation->guest->first_name . " " . $reservation->guest->last_name . " Numero: " . $reservation->guest->phone_number . "",
                'start' => $reservation->arrival_date,
                'end' => $reservation->departure_date,
                'color' => $color,
                'reservation_id' => $reservation->id, // aggiunto per vedere il nome della camera
            ];
        }

        return response()->json($events);
    }
    public function getReservationsByRoom($roomId) {
        $reservations = Reservation::where('room_id', $roomId)->get();
        $events = [];

        foreach ($reservations as $reservation) {
            $events[] = [
                'title' => "Prenotato da: " . $reservation->guest->first_name . " " . $reservation->guest->last_name . " Numero: " . $reservation->guest->phone_number,
                'start' => $reservation->arrival_date,
                'end' => $reservation->departure_date,
                'color' => 'red', // Puoi anche stabilire un colore specifico per ogni stanza se desideri
                'reservation_id' => $reservation->id,
            ];
        }

        return response()->json($events);
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

        return view('reservations.events', ['events' => $events]);
    }


}
