<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Team;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all();
        
        return view('users.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
           'name' => 'required',
           'email' => 'required|email|unique:users,email',
           'team_id' => 'required',
           'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'team_id' => request('team_id'),
            'password' => bcrypt(request('password'))
        ]);

        if(request('team_admin')) {
            $team = Team::find(request('team_id'));
            $team->update([
                'admin_id' => $user->id
            ]);
        }

        return redirect('/users');
    }

    // public function admins()
    // {
    //     $admins = User::where('team_admin', true)->get();
    //     return view('users.admin', compact('admins'));
    // }
}
