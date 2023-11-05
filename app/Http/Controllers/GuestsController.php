<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Reservation;

class GuestsController extends Controller
{



    public function create()
    {
        return view('guests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'date_of_birth' => 'nullable|date',
            'email_address' => 'nullable|email|max:50',
            'phone_number' => ['required', 'string', 'regex:/^[+\s0-9]+$/i', 'min:8', 'max:255', function ($attribute, $value, $fail) {
                $plusCount = substr_count($value, '+');
                if ($plusCount > 1) {
                    $fail('Il campo :attribute può contenere al massimo un carattere "+"');
                }
            }],
            'nationality' => 'nullable|string|max:50',
            'document_number' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:50',
            'state' => 'nullable|string|max:50',
            'zip_code' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:50',
            'tax_id' => 'nullable|string|max:50',
            'vat_number' => 'nullable|string|max:50',
        ]);

        Guest::create($request->all());

        return redirect()->route('guests.index');
    }

    public function show(Guest $guest)
    {
        return view('guests.show', ['guest' => $guest]);
    }

    public function edit(Guest $guest)
    {
        return view('guests.edit', ['guest' => $guest]);
    }

    public function update(Request $request, Guest $guest)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'date_of_birth' => 'nullable|date',
            'email_address' => 'nullable|email|max:50',
            'phone_number' => ['required', 'string', 'regex:/^[+\s0-9]+$/i', 'min:8', 'max:255', function ($attribute, $value, $fail) {
                $plusCount = substr_count($value, '+');
                if ($plusCount > 1) {
                    $fail('Il campo :attribute può contenere al massimo un carattere "+"');
                }
            }],
            'nationality' => 'nullable|string|max:50',
            'document_number' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:50',
            'state' => 'nullable|string|max:50',
            'zip_code' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:50',
            'tax_id' => 'nullable|string|max:50',
            'vat_number' => 'nullable|string|max:50',
        ]);

        $guest->update($request->all());

        return redirect()->route('guests.index')->with('success', 'Informazioni dell\'ospite aggiornate con successo.');
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();
        return redirect()->route('guests.index')->with('success', 'Ospite eliminato con successo.');
    }

    public function dashboard() {
        $guestCount = Guest::count();
        dd($guestCount);
        $latestGuest = Guest::latest()->first();
        return view('dashboard', ['guestCount' => $guestCount, 'latestGuest' => $latestGuest]);
    }
    public function index()
    {
        $guests = Guest::all(); // Assicurati di avere un modello Guest corrispondente
        return view('guests.index', compact('guests'));
    }

    public function showForm()
    {
        // Restituisce la vista che contiene la form per inserire le date
        return view('form');
    }

    public function countGuests(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Calcola il totale delle presenze come il numero di notti moltiplicato per il numero di ospiti sopra i 14 anni per ogni prenotazione nell'intervallo di date
        $reservations = Reservation::where('arrival_date', '>=', $startDate)
            ->where('departure_date', '<=', $endDate)
            ->get();

        $totalPresences = 0;

        foreach ($reservations as $reservation) {
            // Calcola il numero di notti per questa prenotazione
            $nights = $reservation->departure_date->diffInDays($reservation->arrival_date);

            // Assumi che `number_of_guests` sia il numero totale di ospiti e `under_14` sia il numero di ospiti sotto i 14 anni
            $guestsOver14 = $reservation->number_of_guests - $reservation->under_14;

            // Calcola le presenze per questa prenotazione e aggiungile al totale
            $totalPresences += $nights * $guestsOver14;
        }

        return view('form', compact('totalPresences', 'startDate', 'endDate'));
    }


}
