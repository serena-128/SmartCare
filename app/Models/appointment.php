<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'appointment';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'residentid',
        'staffmemberid',
        'date',
        'time',
        'reason',
        'location',
        'rsvp_status',
        'rsvp_comments',
    ];

    protected $casts = [
        'id' => 'integer',
        'residentid' => 'integer',
        'staffmemberid' => 'integer',
        'date' => 'date',
        'reason' => 'string',
        'location' => 'string',
        'rsvp_status' => 'string',
        'rsvp_comments' => 'string',
    ];

    public static $rules = [
        'residentid' => 'nullable|integer',
        'staffmemberid' => 'nullable|integer',
        'date' => 'nullable|date',
        'time' => 'nullable',
        'reason' => 'nullable|string|max:100',
        'location' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
    ];

    // ✅ Fix: Relationship should be named 'resident'
    public function resident()
    {
        return $this->belongsTo(\App\Models\Resident::class, 'residentid');
    }

    // ✅ Fix: Relationship should be named 'staffmember'
    public function staffmember()
    {
        return $this->belongsTo(\App\Models\Staffmember::class, 'staffmemberid');
    }

    public function rsvps()
    {
        return $this->hasMany(\App\Models\AppointmentRsvp::class, 'appointment_id');
    }
}
