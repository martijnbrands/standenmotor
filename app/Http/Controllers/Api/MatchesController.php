<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\User;
use App\Match;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $JWTUser = JWTAuth::user();
        $user = User::find($JWTUser['id']);

        $matches = Match::with('players')->where('teamId', $user->team->teamId)->orderBy('matchDate')->get();

        return $matches;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $JWTUser = JWTAuth::user();
        $user = User::find($JWTUser['id']);

        $matches = $request->all();

        foreach($matches as $match){
            if(!Match::where('matchId', $match['matchId'])->exists()) {
                $m = Match::create([
                    'teamId' => $user->team->teamId,
                    'matchId' => $match['matchId'],
                    'matchDate' => Carbon::parse($match['matchDate'])->format('Y-m-d'),
                    'matchTime' => $match['matchTime'],
                    'awayTeam' => $match['awayTeam'],
                    'homeTeam' => $match['homeTeam'],
                    'field' => $match['field']
                ]);

                if(isset($match['awayUniform'])) $m->update(['awayUniform' => $match['awayUniform']]);

            } else {
                $m = Match::where('matchId', $match['matchId'])->first();

                $m->update([
                    'matchDate' => Carbon::parse($match['matchDate'])->format('Y-m-d'),
                    'matchTime' => $match['matchTime']
                ]);

                if(isset($match['awayUniform'])) $m->update(['awayUniform' => $match['awayUniform']]);
            }
        }
        
        return $matches;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function show(Match $match)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function edit(Match $match)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Match $match)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function destroy(Match $match)
    {
        //
    }
}
