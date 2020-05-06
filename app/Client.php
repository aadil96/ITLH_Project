<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

class Client extends Authenticatable
{
    protected $guard = 'client';

    protected $fillable = ['company_name', 'profile_image', 'email', 'password'];

    // protected $guarded = ['company_name'];

    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }

    public function tags()
    {
        $this->hasMany('App\Tag');
    }

    public function addAssignmentWithFiles($data)
    {

        if (request()->hasFile('specs'))  // This will blow up if 'entcrpt=multi/data' is not specified in form
        {
            $requestedDocument = request()->file('specs');
            $time = time();

            $spec = $time . '-' . $requestedDocument->getClientOriginalName();

            $spec = $requestedDocument->storeAs('uploads', $spec, 'public');

            $tags = explode(',', request('tag')); // Separates tags

            // ddd($spec);

            $assignment = $this->assignments()->create([
                                'client_id' => $this->id,
                                'title' => request('title'),
                                'description' => request('dscrpt'),
                                'specification_document_url' => $spec,
                                'turn_around_time' => request('tat'),
                                'company_name' => request('cmpny'),
                                'cost_low' => request('costLow'),
                                'cost_high' => request('costHigh'),
                                'tags' => request('tag'),
                                'status' => request('status'),
                            ]);

            $assignment->tag($tags);
        }

        // return ddd($this->id);
       
    }
}