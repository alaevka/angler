<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable;

class User extends Eloquent implements \Illuminate\Contracts\Auth\Authenticatable
{

    use Authenticatable;

    protected $collection = 'users';
    protected $primaryKey = '_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static $createRules = array(
        'password'              =>  'required|min:6|confirmed',
        'password_confirmation' =>  'required|min:6',
        'email'                 =>  'required|email|unique:users,email',
        'name'                  =>  'required',
    );

    public static function getCreateRules() {      
        return self::$createRules; 
    }

   
}
