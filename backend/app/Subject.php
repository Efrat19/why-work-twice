<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function homeWorks()
    {
        return $this->hasMany(Homework::class);
    }

}
