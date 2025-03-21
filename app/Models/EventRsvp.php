<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRsvp extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'nextofkin_id',
        'event_title',
        'nextofkin_name',
    ];
}
