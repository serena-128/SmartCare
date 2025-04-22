<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    // Allow mass assignment on these fields:
    protected $fillable = ['date', 'message'];
}
