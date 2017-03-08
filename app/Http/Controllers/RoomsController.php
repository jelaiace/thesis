<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Department;

class RoomsController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms/index', compact('rooms'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('rooms/create', compact('departments'));
    }

    public function store(Request $request) 
    {
        $room = Room::create([
            'name' => $request->get('name'),
            'type' => $request->get('type'),
            'department_id' => $request->get('department_id'),
        ]);

        return redirect('/rooms');
    }

    public function show(Room $room)
    {
        return view('rooms/show', compact('room'));
    }

    public function edit(Room $room)
    {
        $departments = Department::all();
        return view('rooms/edit', compact('room', 'departments'));
    }

    public function update(Request $request, Room $room)
    {
        $room->name = $request->get('name');
        $room->type = $request->get('type');
        $room->department_id = $request->get('department_id');
        $room->save();
        return redirect('/rooms');
    }

    public function delete(Room $room)
    {
        $room->delete();
        return redirect('/rooms');
    }
}
