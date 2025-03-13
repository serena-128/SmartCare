<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'schedule'; // Ensure the correct table name

    protected $fillable = [
        'staffmemberid',
        'staff_role',
        'shiftdate',
        'starttime',
        'endtime',
        'shifttype',
        'requested_shift_id',
        'shift_status',
        'request_reason',
        'approved_by',
    ];

    // ✅ Add the missing static property for validation rules
    public static $rules = [
        'staffmemberid' => 'required|exists:staffmember,id',
        'shiftdate' => 'required|date',
        'starttime' => 'required',
        'endtime' => 'required',
        'shifttype' => 'required|string',
        'request_reason' => 'nullable|string',
    ];

    // Define relationships
    public function staffMember()
    {
        return $this->belongsTo(StaffMember::class, 'staffmemberid');
    }

    public function requestedShift()
    {
        return $this->belongsTo(Schedule::class, 'requested_shift_id');
    }
}
