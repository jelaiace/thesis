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
        $auth = Auth::user();
        $departments = Department::all();
        $professors = $auth->department->users()->where('type', 'professor')->get();
        $subjects = $auth->department->subjects;
        $blocks = $auth->department->blocks;
        $day = strtolower($request->get('day', 'm'));

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
                $query->where('day', $day)
                    ->where(function($query) {
                        $query->where('status', '!=', 'declined')
                            ->orWhereNull('status');
                    });
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
            $schedule->status = 'pending';
            $schedule->is_seen = false;
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
        $schedule->status = $request->get('is_approved')
            ? 'approved'
            : 'declined';

        $schedule->save();

        return $request->expectsJson()
            ? response()->json(['success' => true])
            : redirect()->back();
    }

    public function delete(Schedule $schedule)
    {
        $schedule->delete();
        return response()->json(['success' => true]);
    }

    public function requests() {
        $type = 'requests';

        $departments = Department::all();

        $status = request()->get('status', 'all');

        $pending = Auth::user()->requests()
            ->orderBy('id', 'desc')
            ->where('status', 'pending')
            ->get();

        $requests = Auth::user()->requests()
            ->orderBy('id', 'desc');

        switch($status) {
            case 'all':
                $requests = $requests->whereNotNull('status')->get();
                break;

            case 'pending':
                $requests = $pending;
                break;

            case 'approved':
                $requests = $requests->where('status', 'approved')->get();
                break;

            case 'declined':
                $requests = $requests->where('status', 'declined')->get();
                break;
        }

        return view('schedule.requests', compact('departments', 'status', 'requests', 'pending', 'type'));
    }

    public function incoming() {
        $type = 'incoming';

        $departments = Department::all();

        $status = request()->get('status', 'all');

        $pending = Auth::user()->department->schedules()
            ->orderBy('id', 'desc')
            ->where('status', 'pending')
            ->get();

        $requests = Auth::user()->department->schedules()
            ->orderBy('id', 'desc');

        switch($status) {
            case 'all':
                $requests = $requests->whereNotNull('status')->get();
                break;

            case 'pending':
                $requests = $pending;
                break;

            case 'approved':
                $requests = $requests->where('status', 'approved')->get();
                break;

            case 'declined':
                $requests = $requests->where('status', 'declined')->get();
                break;
        }

        return view('schedule.requests', compact('departments', 'status', 'requests', 'pending', 'type'));
    }
}
