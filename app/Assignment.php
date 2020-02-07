<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use \Conner\Tagging\Taggable;

    protected $fillable = ['client_id', 'title', 'description', 'specification_document_url', 'turn_around_time', 'company_name', 'cost_low', 'cost_high', 'tags', 'status'];


    public function client()
    {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function proposals()
    {
        return $this->hasMany('App\Proposal');
    }
}
