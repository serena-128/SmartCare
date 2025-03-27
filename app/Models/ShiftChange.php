<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'shiftdate',
        'starttime',
        'endtime',
        'shifttype',
        'request_reason',
        'status',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
