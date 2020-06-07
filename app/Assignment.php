<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use \Conner\Tagging\Taggable;

    protected $fillable = ['client_id', 'title', 'description', 'specification_document_url', 'turn_around_time', 'cost_low', 'cost_high', 'tags'];

    protected $guarded = ['status', 'company_name'];

    public function client()
    {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function proposals()
    {
        return $this->hasMany('App\Proposal');
    }
}
