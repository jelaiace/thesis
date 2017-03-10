<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Department;

class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects/index', compact('subjects'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('subjects/create', compact('departments'));
    }

    public function store(Request $request)
    {
        $subject = Subject::create([
            'course_code' => $request->get('course_code'),
            'name' => $request->get('name'),
            'units' => $request->get('units'),
            'department_id' => $request->get('department_id')
            ]);
        return redirect('/subjects');
    }

    public function show(Subject $subject)
    {
        // return view('subjects', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        $departments = Department::all();
        return view('subjects/edit', compact('subject', 'departments'));
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->course_code = $request->get('course_code');
        $subject->name = $request->get('name');
        $subject->units = $request->get('units');
        $user->department_id = $request->get('department_id');
        $subject->save();
        return redirect('/subjects');
    }

    public function delete(Subject $subject)
    {
        $subject->delete();
        return view('/subject');
    }
}
