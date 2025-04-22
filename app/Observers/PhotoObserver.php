<?php

namespace App\Observers;

use App\Models\Photo;
use App\Models\Notification;
use App\Models\NextOfKin;

class PhotoObserver
{
    /**
     * Handle the Photo "created" event.
     *
     * @param  \App\Models\Photo  $photo
     * @return void
     */
    public function created(Photo $photo)
    {
        // Notify all next-of-kin about the new photo gallery addition.
        $nextOfKins = NextOfKin::all();
        
        foreach ($nextOfKins as $nextOfKin) {
            Notification::create([
                'nextofkin_id' => $nextOfKin->id,
                'message'      => 'A new photo has been added to the gallery.',
                'is_new'       => true,
            ]);
        }
    }
}
