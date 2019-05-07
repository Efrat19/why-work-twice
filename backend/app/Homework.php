<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    //


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
