<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class EmergencyAlert
 * @package App\Models
 * @version March 14, 2025, 1:57 am UTC
 *
 * @property \App\Models\Resident $resident
 * @property \App\Models\StaffMember $triggeredBy
 * @property \App\Models\StaffMember $resolvedBy
 * @property integer $residentid
 * @property integer $triggeredbyid
 * @property string $alerttype
 * @property string|\Carbon\Carbon $alerttimestamp
 * @property string $status
 * @property integer $resolvedbyid
 */
class EmergencyAlert extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'emergencyalert'; // ✅ Fixed table name

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $fillable = [
    'alerttype',
    'urgency',
    'details',
    'residentid',
    'triggeredbyid',
    'resolvedbyid',
    'status',
    'alerttimestamp'
];

    protected $casts = [
        'id' => 'integer',
        'residentid' => 'integer',
        'triggeredbyid' => 'integer',
        'alerttype' => 'string',
        'urgency' => 'string',
        'details' => 'string',
        'alerttimestamp' => 'datetime',
        'status' => 'string',
        'resolvedbyid' => 'integer'
    ];

    public static $rules = [
        'residentid' => 'required|integer',
        'triggeredbyid' => 'required|integer',
        'alerttype' => 'required|string|max:50',
        'urgency' => 'nullable|string|max:255',
        'details' => 'nullable|string',
        'alerttimestamp' => 'nullable',
        'status' => 'nullable|string|max:20',
        'resolvedbyid' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];



    /**
     * Define relationship with Resident
     */
   public function resident()
{
    return $this->belongsTo(\App\Models\Resident::class, 'residentid');
}

public function triggeredBy()
{
    return $this->belongsTo(\App\Models\StaffMember::class, 'triggeredbyid');
}

public function resolvedBy()
{
    return $this->belongsTo(\App\Models\StaffMember::class, 'resolvedbyid');
}

}
