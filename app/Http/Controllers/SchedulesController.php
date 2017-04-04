<?php

namespace App\Http\Controllers;

use Auth;
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
        $professors = $department->users()->where('type', 'professor')->get();
        $subjects = $department->subjects;
        $blocks = Block::all();
        $day = strtolower($request->get('day', 'mth'));
        $rooms = Room::where('department_id', $department->id)
            ->with(
                'schedules.professor',
                'schedules.block',
                'schedules.room',
                'schedules.subject',
                'schedules.requester',
                'schedules.requester.department'
            )
            ->with(['schedules' => function($query) use ($request, $day) {
                $query->where('day', $day);
            }])
            ->get();

        return view('schedule.department', compact(
            'professors',
            'subjects',
            'blocks',
            'departments',
            'department',
            'day',
            'rooms'
        ));
    }

    public function store(Request $request)
    {
        $schedule = new Schedule();
        $schedule->professor_id = $request->get('professor_id');
        $schedule->block_id = $request->get('block_id');
        $schedule->subject_id = $request->get('subject_id');
        $schedule->room_id = Room::where('name', $request->get('room'))->first()->id;
        $schedule->day = $request->get('day');
        $schedule->name = 'xx';
        $schedule->start_time = $request->get('start_time');
        $schedule->end_time = $request->get('end_time');

        if ($request->get('is_requested', 0) == 1) {
            $schedule->requester_id = Auth::user()->id;
        }

        $schedule->save();

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

    public function action(Request $request, Schedule $schedule)
    {
        if ($request->get('is_approved')) {
            $schedule->requester_id = 0;
            $schedule->save();
        } else {
            $schedule->delete();
        }

        return response()->json(['success' => true]);
    }

    public function delete(Schedule $schedule)
    {
        $schedule->delete();
        return redirect('/schedule');
    }
}
