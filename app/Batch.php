<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    public function users()
    {
        return $this->hasMany('App\User', 'batch_id');
    }
}
