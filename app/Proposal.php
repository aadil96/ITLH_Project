<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    public function assignment()
    {
        return $this->belongsTo('App\Assignment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
