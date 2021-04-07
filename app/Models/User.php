<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //

    protected $table = 'users';

    public function comments()
    {
        $this->hasMany(Comment::class);
        # code...
    }

    public function favorites()
    {
        $this->hasMany(Favorite::class);
    }

    public function orders()
    {
        $this->hasMany(Order::class);
    }

    
}
