<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
      $rooms = Room::join('schedules', function($join) use ($day) {
      	$join->on('rooms.id', '=', 'schedules.room_id')
      		->where('day', $day);
      })->with(
        'schedules.professor',
        'schedules.block',
        'schedules.room',
        'schedules.subject'
      )->get();

      return view('index-professor', compact(
        'professors',
        'subjects',
        'blocks',
        'day',
        'rooms'
      ));
  	}

    return view('home');
  }
}
