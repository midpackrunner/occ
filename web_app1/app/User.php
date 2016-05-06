<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'user_type'
    ];


    public function articles() {
        return $this->hasMany('App\Article');
    }

    public function isAnAdmin() {
        $usertype = $this->user_type;
        if (strcmp($usertype, "admin") == 0) {
            return true;
        }

        return false;
    }
}
