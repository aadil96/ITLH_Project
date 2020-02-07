<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    protected $guard = 'client';

    protected $fillable = ['company_name', 'profile_image', 'email', 'password'];

    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }

    public function tags()
    {
        $this->hasMany('App\Tag');
    }
}
