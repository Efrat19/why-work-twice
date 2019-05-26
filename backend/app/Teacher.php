<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name'
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function schools()
    {
        return $this->belongsToMany(School::class);
    }

    public function students()
    {
        $this->belongsToMany(User::class);
    }
}
