<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function homeWorks()
    {
        return $this->hasMany(Homework::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

}
