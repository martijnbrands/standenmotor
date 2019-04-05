<?php

namespace App\Http\Controllers\Admin;

use App\Player;
use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $players = Player::all();

        return view('admin.players.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::orderBy('name')->get();
        
        return view('admin.players.create', compact('teams'));
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
            'name'      => 'required|string',
            'goals'     => 'integer|nullable',
            'assists'   => 'integer|nullable',
            'points'    => 'integer|nullable',
            'team_id'   => 'required'
        ]);

        Player::create(request()->all());

        return redirect()->route('admin.players.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        $teams = Team::orderBy('name')->get();

        // return view('admin.players.edit', compact('player',));
        return view('admin.players.edit')
            ->with([
                'player' => $player,
                'teams' => $teams
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        request()->validate([
            'name'      => 'required|string',
            'goals'     => 'integer|nullable',
            'assists'   => 'integer|nullable',
            'points'    => 'integer|nullable',
            'team_id'   => 'required'
        ]);

        $player->update(request()->all());

        return redirect()->route('admin.players.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        $player->delete();
        
        return redirect()->route('admin.players.index');
    }
}
