<?php
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon; // Import Carbon for time formatting

class Schedule extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'schedule';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at', 'shiftdate'];

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
        'approved_by'
    ];

    protected $casts = [
        'id' => 'integer',
        'staffmemberid' => 'integer',
        'staff_role' => 'string',
        'shiftdate' => 'date',
        'starttime' => 'string', // Fixed the issue
        'endtime' => 'string',   // Fixed the issue
        'shifttype' => 'string',
        'requested_shift_id' => 'integer',
        'shift_status' => 'string',
        'request_reason' => 'string',
        'approved_by' => 'integer'
    ];

    /**
     * Accessor to format time fields properly
     */
    public function getStartTimeAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->format('h:i A'); // Formats to 12-hour time
    }

    public function getEndTimeAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->format('h:i A');
    }

    /**
     * Get the staff member assigned to this shift.
     */
    public function staffMember()
    {
        return $this->belongsTo(\App\Models\Staffmember::class, 'staffmemberid');
    }

    /**
     * Get the staff member who approved the shift change request.
     */
    public function approvedBy()
    {
        return $this->belongsTo(\App\Models\Staffmember::class, 'approved_by');
    }
}
