<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Auth;
use App\Department;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = $request->get('q', '');
        if ($query) {
            if ($user->type === 'dean') {
                $courses = $user->department->courses()
                    ->where('name', 'LIKE', '%' . $query . '%')
                    ->get();
            } else {
                $courses = Course::where('name', 'LIKE', '%' . $query . '%')->get();
            }
        } else {
            if ($user->type === 'dean') {
                 $courses = $user->department->courses;
             } else {
                $courses = Course::all();
            }
        }
        return view('courses/index', compact('courses', 'query'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('courses/create', compact('departments'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'name'  => 'required|unique:courses,name,NULL,id,deleted_at,NULL',
            'department_id' => $user->type === 'dean' ? '' : 'required'
        ]);

        $course = new Course();
        $course->name = $request->get('name');
        $course->department_id = $user->type === 'dean'
            ? $user->department->id
            : $request->get('department_id');
        $course->save();

        session()->flash('success', 'Course was successfully created!');
        return redirect('/courses/');
    }
    
    public function show(Course $course)
    {
        return view('courses/show', compact('course'));
    }

    public function edit(Course $course)
    {
         $departments = Department::all();
        return view('courses/edit', compact('course', 'departments'));
    }

    public function update(Request $request, Course $course)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name'  => 'required|unique:courses,name,' . $course->id . ',id,deleted_at,NULL',
            'department_id' => $user->type === 'dean' ? '' : 'required'
        ]);

        
        $course->name = $request->get('name');
        $course->department_id = $user->type === 'dean'
            ? $user->department->id
            : $request->get('department_id');
        $course->save();
        session()->flash('success', 'Course was successfully updated!');
        return redirect('/courses/');
    }

    public function delete(Course $course)
    {
        $course->delete();
        session()->flash('info', 'Course was successfully deleted!');
        return redirect('/courses');
    }
}
