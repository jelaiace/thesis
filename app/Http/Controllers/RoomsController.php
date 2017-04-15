<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use Auth;
use PDF;
use App\Department;

class RoomsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = $request->get('q', '');
        if ($query) {
            if ($user->type ==='dean') {
                $rooms = $user->department->rooms()
                ->where('name', 'LIKE', '%' . $query . '%')
                ->get();
            } else {
                $rooms = Room::where('name', 'LIKE', '%' . $query . '%')->get();
            }
        } else {
            if ($user->type === 'dean') {
                $rooms = $user->department->rooms;
            } else {
                $rooms = Room::all();
            }
        }

        return view('rooms/index', compact('rooms', 'query'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('rooms/create', compact('departments'));
    }

    public function store(Request $request) 
    {
        $user = Auth::user();
        $this->validate($request, [
            'name'  => 'required',
            'type' => 'required|in:lecture,laboratory',
            'department_id' => $user->type === 'dean' ? '' : 'required'
        ]);

        $room = new Room();
        $room->name = $request->get('name');
        $room->type = $request->get('type');
        $room->department_id = $user->type === 'dean'
            ? $user->department->id
            : $request->get('department_id');
        $room->save();

        session()->flash('success', 'Room was successfully created!');
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
        $user = Auth::user();
        $this->validate($request, [
            'name'  => 'required',
            'type' => 'required|in:lecture,laboratory',
            'department_id' => $user->type === 'dean' ? '' : 'required'
        ]);
        
        $room->name = $request->get('name');
        $room->type = $request->get('type');
        $room->department_id = $user->type === 'dean'
            ? $user->department->id
            : $request->get('department_id');
        $room->save();

        session()->flash('success', 'Room was successfully updated!');
        return redirect('/rooms');
    }

    public function delete(Room $room)
    {
        $room->delete();
        session()->flash('success', 'Room was successfully deleted!');
        return redirect()->back();
    }

    public function report(Request $request) 
    {
        $user = Auth::user();
        $rooms = $user->department->rooms;

        $pdf = PDF::loadView('pdf.room', compact('rooms'))
          ->setPaper('a4', 'landscape');

        return $pdf->download('rooms.pdf');
    }
}
