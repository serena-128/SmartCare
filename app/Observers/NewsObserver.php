<?php

namespace App\Observers;

use App\Models\News;
use App\Models\Notification;
use App\Models\NextOfKin;

class NewsObserver
{
    /**
     * Handle the News "created" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function created(News $news)
    {
        // For example, notify all next-of-kin.
        $nextOfKins = NextOfKin::all();

        foreach ($nextOfKins as $nextOfKin) {
            Notification::create([
                'nextofkin_id' => $nextOfKin->id,
                'message'      => 'New news update: ' . $news->title,
                'is_new'       => true,
            ]);
        }
    }
}
