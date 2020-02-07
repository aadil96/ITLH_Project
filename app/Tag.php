<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function clients()
    {
        $this->belongsToMany('App\Client', 'App\User');
    }
}
