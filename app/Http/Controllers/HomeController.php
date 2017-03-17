<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PDF;
use App\Schedule;
use App\User;
use App\Room;
use App\Subject;
use App\Block;
use App\Department;

class HomeController extends Controller
{
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
  	$user = Auth::user();

  	if ($user->type === 'professor') {
      $professors = User::where('type', 'professor')->get();
      $subjects = Subject::all();
      $blocks = Block::all();
      $day = strtolower($request->get('day', 'mth'));

      $rooms = Room::join('schedules', function($join) use ($day, $user) {
      	$join->on('rooms.id', '=', 'schedules.room_id')
      		->where('schedules.day', $day)
          ->where('schedules.professor_id', '=', $user->id);
      })->select('rooms.*', 'schedules.professor_id')->with(
        'schedules.professor',
        'schedules.block',
        'schedules.room',
        'schedules.subject'
      )->with(['schedules' => function($query) use ($request, $user) {
        $query->where('professor_id', $user->id);
      }])->get();

      return view('index-professor', compact(
        'professors',
        'subjects',
        'blocks',
        'day',
        'rooms'
      ));
  	}

    return view('index');
  }

  public function report(Request $request)
  {
    $user = Auth::user();

    $schedules = $user->schedules()
      ->with('room', 'room.department', 'subject', 'block')
      ->get()
      ->sortBy('day_value');

    $pdf = PDF::loadView('pdf.schedules', compact('user'))
      ->setPaper('a4', 'landscape');

    return $pdf->download('schedules.pdf');
  }
}
