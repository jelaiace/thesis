<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('index', compact('courses'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $course = Course::create([
            'name' => $request->get('name')
            ]);
        return redirect('/courses/' . $course->id);
    }
    
    public function show(Course $course)
    {
        return view('show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $course->name = $request->get('name');
        $course->save();
        return redirect('/courses/' . $course->id);
    }

    public function delete(Course $course)
    {
        $course->delete();
        return redirect('/courses');
    }
}
