<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Guest;
use App\Models\Room;
use carbon\carbon;

class ReservationController extends Controller
{
    // viene applicata una ricerca per date
    public function index(Request $request)
    {
        $query = Reservation::query();

        // Controlla se sono stati forniti parametri di ricerca nel form
        $isSearching = $request->filled('first_name') || $request->filled('last_name') || $request->filled(['start_date', 'end_date']);

        // Applica il filtro predefinito solo se non ci sono parametri di ricerca
        if (!$isSearching) {
            $today = now()->format('Y-m-d');
            $query->where('arrival_date', '<=', $today)
                ->where('departure_date', '>=', $today);
        }

        // Applica i filtri in base ai parametri di ricerca
        if ($request->filled(['start_date', 'end_date'])) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $query->where(function ($query) use ($startDate, $endDate) {
                $query->where('arrival_date', '<=', $endDate)
                    ->where('departure_date', '>=', $startDate);
            });
        }

        if ($request->filled('first_name')) {
            $query->whereHas('guest', function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->input('first_name') . '%');
            });
        }

        if ($request->filled('last_name')) {
            $query->whereHas('guest', function ($query) use ($request) {
                $query->where('last_name', 'like', '%' . $request->input('last_name') . '%');
            });
        }

        $reservations = $query->with('guest', 'room')->get();

        return view('reservations.index', ['reservations' => $reservations]);
    }



    public function create(Request $request)
    {
        $rooms = Room::all();
        $guests = Guest::all();
        $selectedGuestId = $request->query('guest_id', null);
        //dd($request->all()); //per assicurarti che il valore sia quello che ti aspetti.
        return view('reservations.create', [
            'rooms' => $rooms,
            'guests' => $guests,
            'selectedGuestId' => $selectedGuestId
        ]);
    }



// Funzione per il salvataggio di una prenotazione
    public function store(Request $request)
    {

        $request->validate([
            'guest_id' => 'required|exists:guests,guest_id',
            'arrival_date' => 'required|date|date_format:Y-m-d|after_or_equal:today|before_or_equal:2100-12-31',
            'departure_date' => 'required|date|date_format:Y-m-d|after:arrival_date|before_or_equal:2100-12-31',

            'room_id' => ['required', function ($attribute, $value, $fail) use ($request) {
                $exists = Reservation::where('room_id', $value)
                    ->where('arrival_date', '<', $request->departure_date)
                    ->where('departure_date', '>', $request->arrival_date)
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
            'note' => 'nullable|string|max:150',
            'tassa_soggiorno' => 'boolean',
            'from_booking' => 'boolean',
        ]);
        $validatedData['tassa_soggiorno'] = $request->has('tassa_soggiorno');
        $validatedData['from_booking'] = $request->has('from_booking');

        $reservation = Reservation::create($request->all());
        return redirect()->route('reservations.show', $reservation);
    }

// mi mostra le mie prenotazioni
    public function show(Reservation $reservation)
    {
        $reservation->load('guest', 'room');
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
                    ->where('arrival_date', '<', $request->departure_date)
                    ->where('departure_date', '>', $request->arrival_date)
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
            'note' => 'nullable|string|max:150',
            'tassa_soggiorno' => 'boolean',
            'from_booking' => 'boolean',
        ]);
        $validatedData['tassa_soggiorno'] = $request->has('tassa_soggiorno');
        $validatedData['from_booking'] = $request->has('from_booking');

        $reservation->update($request->all());

        return redirect()->route('reservations.show', $reservation);
    }


    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index');
    }


    public function getReservationsForCalendar() {
        // Aggiunto l'eager loading per le relazioni guest e room
        $reservations = Reservation::with(['guest', 'room'])->get();
        // Stampa e interrompi l'esecuzione qui
//        dd($reservations);
        $events = [];

        foreach ($reservations as $reservation) {
            $roomName = $reservation->room ? $reservation->room->name : 'Stanza non trovata';
            // Determina il colore in base all'ID della stanza
            $color = 'red'; // default color
            switch ($reservation->room_id) {
                case 1:
                    $color = 'blue';
                    break;
                case 2:
                    $color = 'green';
                    break;
                case 3:
                    $color = 'violet';
                    break;
                case 4:
                    $color = 'red';
                    break;
                // Puoi aggiungere altri case qui per altre stanze se necessario
            }

            $events[] = [
                'title' => "Stanza: " . $roomName. " - Prenotato da: " . $reservation->guest->first_name . " " . $reservation->guest->last_name . " Numero: " . $reservation->guest->phone_number,
                'start' => \Carbon\Carbon::createFromFormat('d/m/Y', $reservation->arrival_date)->format('Y-m-d'),
                'end' => \Carbon\Carbon::createFromFormat('d/m/Y', $reservation->departure_date)->format('Y-m-d'),
                'color' => $color,
                'reservation_id' => $reservation->id,
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
                'start' => \Carbon\Carbon::createFromFormat('d/m/Y', $reservation->arrival_date)->format('Y-m-d'),
                'end' => \Carbon\Carbon::createFromFormat('d/m/Y', $reservation->departure_date)->format('Y-m-d'),
                'color' => 'red', // Posso cambiare colore in base a quello che voglio
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
