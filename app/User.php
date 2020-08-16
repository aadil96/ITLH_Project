<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;

// use User;
use Batch;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'batch_id',
        'name',
        'email',
        'phone',
        'profile_image_url',
        'cv_url',
        'competencies',
        'user_type',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public const VALIDATE = [
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            'unique:users',
        ],
    ];

    public function batch()
    {
        return $this->belongsTo('App\Batch');
    }

    public function tags()
    {
        $this->hasMany('App\Tag');
    }

    public function proposals()
    {
        return $this->hasMany('App\Proposal');
    }

    public function saveImageWithNameInPublicPath($request)
    {
        $image = time() . '-' . $request->getClientOriginalName();

        $image = $request->storeAs('uploads', $image, 'public');

        return $image;
    }
}
