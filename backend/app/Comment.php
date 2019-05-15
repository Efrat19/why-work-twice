<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
         'user_id','homework_id','header','body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function homework()
    {
        return $this->belongsTo(Homework::class);
    }

}
