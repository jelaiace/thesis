<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Block;
use Auth;
use PDF;
use App\Course;

class BlocksController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $request->get('q', '');

        if ($query) {
            if ($user->type === 'dean') {
                $blocks = $user->department->blocks()
                    ->where('blocks.name', 'LIKE', '%' . $query . '%')
                    ->get();
            } else {
                $blocks = Block::where('name', 'LIKE', '%' . $query . '%')->get();
            }
        } else {
            if ($user->type === 'dean') {
                $blocks = $user->department->blocks;
            } else {
                $blocks = Block::all(); 
            }
        }

        return view('blocks/index', compact('blocks', 'query'));
    }

    public function create()
    {
        $courses = Course::all();

        return view('blocks/create', compact('courses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|unique:blocks,name,NULL,id,deleted_at,NULL',
            'course_id' => 'required',
            'year_level' => 'required',
            'semester' => 'required'
        ]);
        
        $block = Block::create([
            'name' => $request->get('name'),
            'course_id' =>$request->get('course_id'),
            'year_level' => $request->get('year_level'),
            'semester' => $request->get('semester')
        ]);

        session()->flash('success', 'Block was successfully created!');
        return redirect('/blocks');
    }

    public function show(Block $block)
    {
        $schedules = $block->schedules()
            ->confirmed()
            ->orderBy('end_time', 'asc')
            ->get();

        $groups = $schedules->groupBy(function($schedule) {
            return $schedule->day_name;
        });

        return view('blocks/show', compact('block', 'groups'));
    }

    public function edit(Block $block)
    {
        $courses = Course::all();
        return view('blocks/edit', compact('block', 'courses'));
    }

    public function update(Request $request, Block $block)
    {
        $this->validate($request, [
            'name'  => 'required|unique:blocks,name,' . $block->id . ',id,deleted_at,NULL',
            'course_id' => 'required',
            'year_level' => 'required',
            'semester' => 'required'
        ]); 
        $block->name = $request->get('name');
        $block->course_id = $request->get('course_id');
        $block->year_level = $request->get('year_level');
        $block->semester = $request->get('semester');
        $block->save();
         session()->flash('success', 'Block was successfully updated!');
        return redirect('/blocks');
    }

    public function delete(Block $block)
    {
        $block->delete();
        session()->flash('info','Block was successfully deleted!');
        return redirect('/blocks/');
    }

    public function report(Request $request)
    {
        $user = Auth::user();

        $blocks = $user->department->blocks()
            ->with(['schedules' => function($query) {
                return $query->orderBy('start_time', 'asc');
            }])
            ->get()
            ->each(function($block) {
                $block->days = $block->schedules->groupBy(function($schedule) {
                    return $schedule->day_name;
                });
            });

        $pdf = PDF::loadView('pdf.block', compact('blocks', 'user'))
          ->setPaper('a4', 'landscape');

        return $pdf->download('blocks.pdf');
    }
}
