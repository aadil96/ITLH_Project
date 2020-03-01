<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = ['assignment_id', 'user_id', 'cover_letter', 'status'];
    
    public function assignment()
    {
        return $this->belongsTo('App\Assignment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
