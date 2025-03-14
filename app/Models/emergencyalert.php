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

    protected $table = 'emergencyalerts'; // ✅ Fixed table name

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'residentid',
        'triggeredbyid',
        'alerttype',
        'alerttimestamp',
        'status',
        'resolvedbyid'
    ];

    protected $casts = [
        'id' => 'integer',
        'residentid' => 'integer',
        'triggeredbyid' => 'integer',
        'alerttype' => 'string',
        'alerttimestamp' => 'datetime',
        'status' => 'string',
        'resolvedbyid' => 'integer'
    ];

    public static $rules = [
        'residentid' => 'required|integer',
        'triggeredbyid' => 'required|integer',
        'alerttype' => 'required|string|max:50',
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
        return $this->belongsTo(Resident::class, 'residentid');
    }

    /**
     * Define relationship with StaffMember who triggered the alert
     */
    public function triggeredBy()
    {
        return $this->belongsTo(StaffMember::class, 'triggeredbyid');
    }

    /**
     * Define relationship with StaffMember who resolved the alert
     */
    public function resolvedBy()
    {
        return $this->belongsTo(StaffMember::class, 'resolvedbyid');
    }
}
