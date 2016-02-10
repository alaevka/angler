<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Post extends Eloquent
{

    protected $collection = 'posts';

    protected $fillable = [
        'user_id', 'text',
    ];

    protected static $createRules = array(
        'user_id'              	=>  'required',
        'text' 					=>  'required',
        
    );

    public static function getCreateRules() {      
        return self::$createRules; 
    }
}
