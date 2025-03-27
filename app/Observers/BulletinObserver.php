<?php

namespace App\Observers;

use App\Models\Bulletin;
use App\Models\Notification;
use App\Models\NextOfKin;

class BulletinObserver
{
    /**
     * Handle the Bulletin "created" event.
     *
     * @param  \App\Models\Bulletin  $bulletin
     * @return void
     */
    public function created(Bulletin $bulletin)
    {
        // If you want to notify all next-of-kin
        $nextOfKins = NextOfKin::all();
        
        foreach ($nextOfKins as $nextOfKin) {
            Notification::create([
                'nextofkin_id' => $nextOfKin->id,
                'message'      => 'New bulletin posted: ' . $bulletin->title,
                'is_new'       => true,
            ]);
        }
    }
}
