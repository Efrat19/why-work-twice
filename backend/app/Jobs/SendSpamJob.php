<?php

namespace App\Jobs;

use App\Comment;
use App\Mail\SpamEmail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendSpamJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->users = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


//        Comment::create([
//            'user_id' => 1,
//            'homework_id' => 1,
//            'header' => 1,
//            'body' => 1
//        ]);
        $user = User::find(185937);
          Mail::to($user)->send(new SpamEmail($user));
    }
}
