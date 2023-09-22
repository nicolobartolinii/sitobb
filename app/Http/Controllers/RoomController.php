<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', ['rooms' => $rooms]);
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')->with('success', 'Stanza creata con successo.');
    }

    public function show(Room $room)
    {
        return view('rooms.show', ['room' => $room]);
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', ['room' => $room]);
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index')->with('success', 'Stanza aggiornata con successo.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Stanza eliminata con successo.');
    }
    public function listRooms()
    {
        $rooms = Room::getAllRooms();
        return view('calendaroom', ['rooms' => $rooms]);
    }
    public function showAllCalendars()
    {
        $rooms = Room::all();
        return view('all-calendars', ['rooms' => $rooms]);
    }

}
