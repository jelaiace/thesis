<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Block;
use App\Course;

class BlocksController extends Controller
{
    public function index()
    {
        $blocks = Block::all();

        return view('blocks/index', compact('blocks'));
    }

    public function create()
    {
        $courses = Course::all();

        return view('blocks/create', compact('courses'));
    }

    public function store(Request $request)
    {

        $block = Block::create([
            'name' => $request->get('name'),
            'course_id' =>$request->get('course_id'),
            'year_level' => $request->get('year_level'),
            'semester' => $request->get('semester')
            ]);
        return redirect('/blocks');
    }

    public function show(Block $block)
    {
        return view('blocks/show', compact('block'));
    }

    public function edit(Block $block)
    {
        $courses = Course::all();
        return view('blocks/edit', compact('block', 'courses'));
    }

    public function update(Request $request, Block $block)
    {
        $block->name = $request->get('name');
        $block->course_id = $request->get('course_id');
        $block->year_level = $request->get('year_level');
        $block->semester = $request->get('semester');
        $block->save();
        return redirect('/blocks');
    }

    public function delete(Block $block)
    {
        $block->delete();
        return redirect('/blocks/');
    }
}
