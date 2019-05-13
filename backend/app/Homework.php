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
        'description', 'user_id','school_id','subject_id','source','views','downloads','rating'
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

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class);
    }
}
