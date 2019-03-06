<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Team::Class);

        $teams = Team::all();
        
        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Team::Class);

        $teamAdmins = User::doesntHave('team')
                            ->where('account_type', 'team_admin')
                            ->orderBy('name')
                            ->get();

        return view('admin.teams.create')->with('teamAdmins', $teamAdmins);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('store', Team::Class);

        request()->validate([
            'name' => 'required|string',
            'teamId' => 'required|string'
        ]);

        $team = Team::create([
            'name' => request('name'),
            'teamId' => request('teamId')
        ]);

        if(request('team_admin') !== null) { $team->update([ 'user_id' => request('team_admin') ]); }

        return redirect()->route('admin.teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        $this->authorize('store', Team::Class);

        return view('admin.teams.show')->with('team', $team);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        
        $this->authorize('edit', Team::Class);

        $teamAdmins = User::doesntHave('team')
                            ->where('account_type', 'team_admin')
                            ->orderBy('name')
                            ->get();

        return view('admin.teams.edit')
            ->with([
                'team' => $team,
                'teamAdmins' => $teamAdmins
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $this->authorize('update', Team::Class);

        request()->validate([
            'name' => 'required|string',
            'teamId' => 'required|string'
        ]);

        $team->update([
            'name' => request('name'),
            'teamId' => request('teamId')
        ]);

        if(request('team_admin') !== null) { $team->update([ 'user_id' => request('team_admin') ]); }


        return redirect()->route('admin.teams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $this->authorize('destroy', Team::Class);

        $team->delete();

        return redirect()->route('admin.teams.index');
    }
}
