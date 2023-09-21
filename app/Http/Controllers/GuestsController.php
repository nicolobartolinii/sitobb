<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;

class GuestsController extends Controller
{

    public function index()
    {
        $guests = Guest::all();
        return view('guests.index', ['guests' => $guests]);
    }

    public function create()
    {
        return view('guests.create');
    }

    public function store(Request $request)
    {
        /* $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'date_of_birth' => 'date',
            'email_address' => 'email|max:50',
            'phone_number' => 'string|max:50',
            'nationality' => 'string|max:50',
            'document_number' => 'string|max:50',
            'city' => 'string|max:50',
            'state' => 'string|max:50',
            'zip_code' => 'string|max:50',
            'address' => 'string|max:50',
            'tax_id' => 'string|max:50',
            'vat_number' => 'string|max:50',
        ]); */

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
}
