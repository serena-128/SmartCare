<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule'; // ✅ or 'schedules' depending on your table

    protected $fillable = [
        'staffmemberid',
        'shiftdate',
        'starttime',
        'endtime',
        'shifttype',
        'shift_status',
        'requested_shift_id',
        'request_reason',
    ];

    public function staff()
    {
        return $this->belongsTo(\App\Models\StaffMember::class, 'staffmemberid');
    }
}
