<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\User;
use App\Room;
use App\Subject;
use App\Block;
use App\Department;

class SchedulesController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('schedule.index', compact('departments'));
    }

    public function department(Request $request, Department $department)
    {
        $departments = Department::all();
        $professors = User::where('type', 'professor')->get();
        $subjects = Subject::all();
        $blocks = Block::all();
        $rooms = Room::where('department_id', $department->id)
            ->get()
            ->load(['schedules' => function($query) use ($request) {
                $query->where('day', $request->get('day', 'mth'));
            }])
            ->load(
                'schedules.professor',
                'schedules.block',
                'schedules.room',
                'schedules.subject'
            );

        return view('schedule.department', compact(
            'professors',
            'subjects',
            'blocks',
            'departments',
            'rooms'
        ));
    }

    public function store(Request $request)
    {
        $schedule = Schedule::create([
            'professor_id' => $request->get('professor_id'),
            'block_id' => $request->get('block_id'),
            'subject_id' => $request->get('subject_id'),
            'room_id' => Room::where('name', $request->get('room'))->first()->id,
            'day' => $request->get('day'),
            'name' => 'xx',
            'start_time' => $request->get('start_time'),
            'end_time' => $request->get('end_time')
        ]);

        return response()->json($schedule->load(['block', 'subject', 'room', 'professor']));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $schedule->name = 'xx';
        $schedule->block_id = $request->get('block_id');
        $schedule->room_id = Room::where('name', $request->get('room'))->first()->id;
        $schedule->subject_id = $request->get('subject_id');
        $schedule->professor_id = $request->get('professor_id');
        $schedule->start_time = $request->get('start_time');
        $schedule->end_time = $request->get('end_time');
        $schedule->save();

        return response()->json($schedule->load(['subject', 'block', 'room', 'professor']));
    }

    public function delete(Schedule $schedule)
    {
        $schedule->delete();
        return redirect('/schedule');
    }
}
