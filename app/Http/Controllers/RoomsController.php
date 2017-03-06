<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class RoomsController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms/index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms/create');
    }

    public function store(Request $request) 
    {
        $room = Room::create([
            'name' => $request->get('name'),
            'type' => $request->get('type')
            ]);
        return redirect('/rooms');
    }

    public function show(Room $room)
    {
        return view('rooms/show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('rooms/edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $room->name = $request->get('name');
        $room->type = $request->get('type');
        $room->save();
        return redirect('/rooms/'. $room->id);
    }

    public function delete(Room $room)
    {
        $room->delete();
        return redirect('/rooms');
    }
}
