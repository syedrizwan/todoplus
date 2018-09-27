<?php

namespace App\Listeners;

use App\Group;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateDefaultGroup
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
		if (Group::where([['user_id', $event->user->id], ['title', 'General']])->count() == 0) {
			$group = new Group();
			$group->user_id = $event->user->id;
			$group->title = 'General';
			$group->url_slug = 'general';

			$group->save();
		}
    }
}
