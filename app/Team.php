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
        'name', 'admin_id'
    ];

    public function admin()
    {
        return $this->hasOne(User::class);
    }
}
