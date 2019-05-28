<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Homework
 * @package App
 *
 * @param name string
 */
class Homework extends Model
{
    //
    protected $fillable = [
        'description', 'user_id','school_id','source','views','downloads','rating'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function favorites()
    {
        return $this->belongsToMany(User::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function rating()
    {
        return $this->hasMany(Rate::class);
    }

    public function getAvgRating()
    {
        return $this->rating()->avg('value') ?: 0;
    }

}
