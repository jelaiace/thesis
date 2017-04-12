<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use Auth;
use App\Department;

class SubjectsController extends Controller
{
    public function index(Request $request)
    {  
        $user = Auth::user();
        $query = $request->get('q', '');

        if ($query) {
            if ($user->type === 'dean') {
                $subjects = $user->department->subjects()
                    ->where('name', 'LIKE', '%' . $query . '%')
                    ->get();
            } else {
                $subjects = Subject::where('name', 'LIKE', '%' . $query . '%')->get();
            }
        } else {
            if ($user->type === 'dean') {
                $subjects = $user->department->subjects;
            } else {
                $subjects = Subject::all();
            }
        }

        return view('subjects/index', compact('subjects', 'query'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('subjects/create', compact('departments'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'course_code' => 'required',
            'name' => 'required',
            'units' => 'required',
            'department_id' => 'required'
        ]);

        $subject = Subject::create([
            'course_code' => $request->get('course_code'),
            'name' => $request->get('name'),
            'units' => $request->get('units'),
            'department_id' => $request->get('department_id')
            ]);
        session()->flash('success', 'Subject was successfully created!');
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
         $this->validate($request,[
            'course_code' => 'required',
            'name' => 'required',
            'units' => 'required',
            'department_id' => 'required'
        ]);
         
        $subject->course_code = $request->get('course_code');
        $subject->name = $request->get('name');
        $subject->units = $request->get('units');
        $subject->department_id = $request->get('department_id');

        $subject->save();
        session()->flash('success', 'Subject was successfully updated!');
        return redirect('/subjects');
    }

    public function delete(Subject $subject)
    {
        $subject->delete();
        return view('/subject');
    }
}
