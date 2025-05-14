<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule'; // ✅ Your table name

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

    public $timestamps = false; // 👈 Add this if your table has no created_at/updated_at

    public function staff()
    {
        return $this->belongsTo(StaffMember::class, 'staffmemberid');
    }
}
