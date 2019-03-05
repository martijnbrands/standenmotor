<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'account_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAccountTypeAttribute($value)
    {
        $value = str_replace('_', ' ', $value);
        $value = ucwords($value, ' ');
        
        return $value;
    }

    public static function getEnumValues($name)
    {
        $instance = new static; // create an instance of the model to be able to get the table name
        $type = \DB::select( \DB::raw('SHOW COLUMNS FROM '. \DB::getTablePrefix() . $instance->getTable() .' WHERE Field = "' . $name . '"') )[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach(explode(',', $matches[1]) as $value){
            $v = trim( $value, "'" );
            $enum[] = $v;
        }
        return $enum;
    }

    public function team()
    {
        return $this->hasOne(Team::class);
    }

    public function isSuperAdmin()
    {
        if($this->account_type === 'Super Admin') return true;
    }
}
