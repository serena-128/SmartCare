<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

/**
 * Class StaffMember
 * @package App\Models
 * @version February 12, 2025, 9:27 pm UTC
 */
class StaffMember extends Model
{
    use SoftDeletes, HasFactory, Notifiable;

    public $table = 'staffmember';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'reportsto',
        'firstname',
        'lastname',
        'staff_role',
        'contactnumber',
        'email',
        'startdate'
    ];

    protected $casts = [
        'id' => 'integer',
        'reportsto' => 'integer',
        'firstname' => 'string',
        'lastname' => 'string',
        'staff_role' => 'string',
        'contactnumber' => 'string',
        'email' => 'string',
        'startdate' => 'date'
    ];

    public static $rules = [
        'reportsto' => 'nullable|integer',
        'firstname' => 'nullable|string|max:50',
        'lastname' => 'nullable|string|max:50',
        'staff_role' => 'nullable|string|max:50',
        'contactnumber' => 'nullable|string|max:15',
        'email' => 'nullable|string|max:100',
        'startdate' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function reportsto()
    {
        return $this->belongsTo(\App\Models\Role::class, 'reportsto');
    }

    public function appointments()
    {
        return $this->hasMany(\App\Models\Appointment::class, 'staffmemberid');
    }

    public function diagnosis()
    {
        return $this->hasMany(\App\Models\Diagnosi::class, 'lastupdatedby');
    }

    public function dietaryrestrictions()
    {
        return $this->hasMany(\App\Models\Dietaryrestriction::class, 'lastupdatedby');
    }

    public function doses()
    {
        return $this->hasMany(\App\Models\Dose::class, 'prescribedby');
    }

    public function emergencyalerts()
    {
        return $this->hasMany(\App\Models\Emergencyalert::class, 'triggeredbyid');
    }

    public function emergencyalert1s()
    {
        return $this->hasMany(\App\Models\Emergencyalert::class, 'resolvedbyid');
    }

    public function schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class, 'staffmemberid');
    }

    public function stafftasks()
    {
        return $this->hasMany(\App\Models\Stafftask::class, 'staffmemberid');
    }

    public function standardtasks()
    {
        return $this->hasMany(\App\Models\Standardtask::class, 'assignedto');
    }

    public function standardtask2s()
    {
        return $this->hasMany(\App\Models\Standardtask::class, 'completedby');
    }
    public function resident()
    {
        return $this->hasMany(Resident::class, 'assigned_staff_id');
    }
}
