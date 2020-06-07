<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

class Client extends Authenticatable
{
	protected $guard = 'client';

	protected $fillable = [
		'company_name',
		'profile_image',
		'email',
		'password',
	];

	public function assignments()
	{
		return $this->hasMany('App\Assignment');
	}

	public function tags()
	{
		$this->hasMany('App\Tag');
	}

    public function saveImageWithNameInPublicPath($request)
    {
        $image = time() . '-' . $request->getClientOriginalName();

        $image = $request->storeAs('uploads', $image, 'public');

        return $image;
    }

	public function validateAndCreateAssignment()
	{
        if (request()->hasFile('specs')) {
            $spec = $this->saveImageWithNameInPublicPath(request('specs'));
        } else {
            $spec = null;
        }

        request()->validate([
			'title' => ['required', 'max:125'],
			'dscrpt' => ['required'],
			'tat' => ['numeric'],
			'costLow' => ['numeric'],
			'costHigh' => ['numeric'],
			'tag' => ['min:3', 'max:50'],
		]);

        $tags = explode(',', request('tag')); // Separates tags


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
}
