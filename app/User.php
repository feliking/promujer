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
        'name', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function city(){
        return $this->belongsTo('App\City');
    }
    public function roles(){
        return $this->belongsToMany('App\Role');
    }
    public function flagRole($role_id){
        foreach ($this->roles as $rol) {
            if ($rol->role_id === $role_id) {
                return true;
            }
        }
        return false;
    }
}
