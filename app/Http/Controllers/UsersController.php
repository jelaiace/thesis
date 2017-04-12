<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Department;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $request->get('q', '');

        if ($query) {
            if ($user->type === 'dean') {
                $users = $user->department->users()
                ->where('name', 'LIKE', '%' . $query . '%')
                ->get();
            } else {
                $users = User::where('name', 'LIKE', '%' . $query . '%')->get();
            }
        } else {
            if ($user->type === 'dean') {
                $users = $user->department->users;
            } else {
                $users = User::all();
            }
        }

        return view('users/index', compact('users', 'query'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('users/create', compact('departments'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'type' => 'required|in:admin,dean,professer,vice-president,president',
            'department_id' => 'required'
        ]);

        $users = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'type' => $request->get('type'),
            'department_id' => $request->get('department_id')
        ]);

        session()->flash('success', 'User was successfully created!');
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
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'min:8',
            'type' => 'required|in:admin,dean,professer,vice-president,president',
            'department_id' => 'required'
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->type = $request->get('type');
        $user->department_id = $request->get('department_id');

        if ($request->has('password')) {
            $user->password = bcrypt($request->get('password'));
        }

        $user->save();
        session()->flash('success', 'User was successfully updated!');
        return redirect('/users');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect('/users');
    }
}