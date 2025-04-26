<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule'; // ✅ your table is called schedule

    protected $fillable = [
        'roleid',
        'staffmemberid',
        'shiftdate',
        'starttime',
        'endtime',
        'shifttype',
        'requested_shift_id',
        'shift_status',
        'request_reason',
        'approved_by',
    ];

    public function staff()
    {
        return $this->belongsTo(\App\Models\StaffMember::class, 'staffmemberid');
    }
}
