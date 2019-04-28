<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'teamId',
        'matchId',
        'matchDate',
        'matchTime',
        'awayTeam',
        'awayUniform',
        'homeTeam',
        'field'
    ];

    public function players()
    {
        return $this->belongsToMany(Player::class);
    }
}
