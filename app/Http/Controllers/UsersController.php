<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use PDF;
use App\Department;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        // dd($user);
        $query = null;
        $sort = $request->get('sort', '');
        $first_name = $request->get('first_name', '');
        $last_name = $request->get('last_name', '');

        if ($user->type === 'dean') {
            $query = $user->department->users();
        } else {
            $query = new User();
        }

        if ($first_name) {
            $query = $query->where('first_name', 'LIKE', "%{$first_name}%");
        }

        if ($last_name) {
            $query = $query->where('last_name', 'LIKE', "%{$last_name}%");
        }

        if ($sort) {
            $order = substr($sort, 0, 1) === '-' ? 'desc' : 'asc';
            $field = substr($sort, 0, 1) === '-' ? substr($sort, 1) : $sort;
            $query = $query->orderBy($field, $order);
        }

        $users = $query->get();

        return view('users/index', compact('users', 'first_name', 'last_name', 'sort'));
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
            'first_name'  => 'required',
            'last_name'  => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'type' => $auth->type === 'dean' ? '' : 'required|in:admin,dean,professor,vice-president,president',
            'department_id' => $auth->type !== 'dean' ? 'required_if:type,dean|required_if:type,professor' : ''
        ]);

        $type = $request->get('type');

        $user = new User();
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->type = $auth->type === 'dean'
            ? 'professor'
            : $request->get('type');
        $user->department_id = $auth->type === 'dean'
            ? $auth->department->id
            : ($type === 'dean' || $type === 'professor' ? $request->get('department_id') : 0);
        $user->save();

        session()->flash('success', 'User was successfully created!');
        return redirect('/users');
    }
    
    public function show(User $user)
    {
        $schedules = $user->schedules()
            ->confirmed()
            ->orderBy('end_time', 'asc')
            ->get();

        $groups = $schedules->groupBy(function($schedule) {
            return $schedule->day_name;
        });

        
        return view('users/show', compact('user', 'groups'));
    }

    public function edit(User $user)
    {
        $departments = Department::all();
        return view('users/edit', compact('user', 'departments'));
    }

    public function update(Request $request, User $user)
    {
        $auth = Auth::user();

        $rules = array_merge([
            'first_name'  => 'required',
            'last_name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'confirmed'
        ], $request->has('password') ? ['password' => 'min:8|confirmed'] : []);

        $this->validate($request, $rules);
        
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
       
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

    public function report(Request $request)
    {
        $auth = Auth::user();
        $users = $auth->department->users;

        $pdf = PDF::loadView('pdf.users', compact('users'))
          ->setPaper('a4', 'landscape');

        return $pdf->download('users.pdf');
    }
}