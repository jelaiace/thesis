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
        $auth = Auth::user();
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'type' => 'required|in:admin,dean,professor,vice-president,president',
            'department_id' => $auth->type === 'dean' ? '' : 'required'
        ]);

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->type = $request->get('type');
        $user->department_id = $auth->type === 'dean'
            ? $auth->department->id
            : $request->get('department_id');
        $user->save();

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
         $auth = Auth::user();
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'type' => 'required|in:admin,dean,professor,vice-president,president',
            'department_id' => $auth->type === 'dean' ? '' : 'required'
        ]);

        
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->type = $request->get('type');
        $user->department_id = $auth->type === 'dean'
            ? $auth->department->id
            : $request->get('department_id');
       
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
        session()->flash('info', 'User was successfully deleted!');
        return redirect()->back();
    }
}