<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'school_id', 'subject_id', 'permission_id', 'image', 'is_subscribed', 'remember_token', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function homeworks()
    {
        return $this->hasMany(Homework::class);
    }

    public function getAvgRating()
    {
        return array_reduce($this->homeworks()->get()->map(function ($hw) {
            return $hw->getAvgRating();
        })->toArray(), function ($v1, $v2) {
            return $v1 + $v2;
        });
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Homework::class);
    }

    public function isAdmin()
    {
        return $this->permission['id'] > 1;
    }

    public function isSuperAdmin()
    {
        return $this->permission['id'] > 2;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();  // Eloquent model method
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'user' => [
                'id' => $this->id,
            ]
        ];
    }
}
