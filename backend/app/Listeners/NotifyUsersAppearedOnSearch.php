<?php

namespace App\Listeners;

use App\Events\SearchMade;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUsersAppearedOnSearch
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SearchMade  $event
     * @return void
     */
    public function handle(SearchMade $event)
    {
        //
    }
}
