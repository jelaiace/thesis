<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::all();

        $query = $request->get('q', '');

        if ($query) {
            $departments = Department::where('name', 'LIKE', '%' . $query . '%')->get();
        } else {
            $departments = Department::all();
        }

        return view('departments.index', compact('departments', 'query'));
    }

    public function create()
    {
        return view('departments/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|unique:departments,name,NULL,id,deleted_at,NULL',
        ]);
        $department = Department::create([
            'name' => $request->get('name')
        ]);
        session()->flash('success', 'Department was successfully created!');
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
         $this->validate($request, [
            'name'  => 'required|unique:departments,name,' . $department->id . ',id,deleted_at,NULL',
        ]);
        $department->name = $request->get('name');
        $department->save();
        session()->flash('success', 'Department was successfully updated!');
        return redirect('/departments');
    }

    public function delete(Department $department)
    {
        $department->delete();
        session()->flash('info', 'Department was successfully deleted!');
        return redirect()->back();
    }
}
