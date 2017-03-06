<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users/index', compact('users'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('users/create', compact('departments'));
    }

    public function store(Request $request)
    {
        $users = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'type' => $request->get('type'),
            'department_id' => $request->get('department_id')
        ]);

        return redirect('/users');
    }
    
    public function show(User $user)
    {
        return view('users/show', compact('user'));
    }

    public function edit(User $user)
    {
        $departments = Department::all();
        return view('users/edit', compact('user', 'departments'));
    }

    public function update(Request $request, User $user)
    {
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->type = $request->get('type');
        $user->department_id = $request->get('department_id');
        $user->save();
        return redirect('/users');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect('/users');
    }
}