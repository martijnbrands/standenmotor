<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'goals', 'assists', 'points', 'team_id'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
