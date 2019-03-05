<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'goals', 'assists', 'points', 'user_id'
    ];

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
