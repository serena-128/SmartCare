<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_member_id',
        'shift_date',
        'start_time',
        'end_time',
    ];

    // 👇 Define relationship to StaffMember
    public function staffMember()
    {
        return $this->belongsTo(StaffMember::class, 'staff_member_id');
    }
}
