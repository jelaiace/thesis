<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments/create');
    }

    public function store(Request $request)
    {
        $department = Department::create([
            'name' => $request->get('name')
        ]);

        return redirect('/departments');
    }
    
    public function show(Department $department)
    {
        return view('show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('departments/edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $department->name = $request->get('name');
        $department->save();
        return redirect('/departments');
    }

    public function delete(Department $department)
    {
        $department->delete();
        return redirect('/departments');
    }
}
