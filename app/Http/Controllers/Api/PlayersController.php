<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\User;
use App\Player;
use App\Team;
use App\Http\Resources\PlayerCollection;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($teamId)
    {
        $team = Team::where('teamId', $teamId)->firstOrFail();
        return new PlayerCollection(Player::where('team_id', $team->id)->get(), $team);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|string'
        ]);

        $JWTUser        = JWTAuth::user();
        $user           = User::find($JWTUser['id']);

        $player = Player::create([
            'name'      => request('name'),
            'team_id'   => $user->team->id,
            'goals'     => 0,
            'assists'   => 0,
            'points'    => 0
        ]);

        return $player;
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
        //
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
            'name' => 'required|string',
            'goals' => 'nullable|integer|min:0',
            'assists' => 'nullable|integer|min:0'
        ]);

        $player->update([
            'name' => request('name'),
            'goals' => request('goals'),
            'assists' => request('assists'),
            'points' => $this->calculatePoints($request)
        ]);

        return $request;
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

        return;
    }

    public function calculatePoints($request)
    {
        return ($request->goals * 2) + $request->assists;
    }
}
