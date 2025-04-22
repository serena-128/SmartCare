<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';  // Ensure the correct table name if it's not 'schedules'

    // You can define relationships, fillable fields, etc.
    protected $fillable = ['staff_id', 'day', 'time', 'task']; // Example attributes
}
