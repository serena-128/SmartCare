<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class StaffMember
 * @package App\Models
 * @version February 12, 2025, 9:27 pm UTC
 *
 * @property \App\Models\Role $reportsto
 * @property \Illuminate\Database\Eloquent\Collection $appointments
 * @property \Illuminate\Database\Eloquent\Collection $diagnosis
 * @property \Illuminate\Database\Eloquent\Collection $dietaryrestrictions
 * @property \Illuminate\Database\Eloquent\Collection $doses
 * @property \Illuminate\Database\Eloquent\Collection $emergencyalerts
 * @property \Illuminate\Database\Eloquent\Collection $emergencyalert1s
 * @property \Illuminate\Database\Eloquent\Collection $schedules
 * @property \Illuminate\Database\Eloquent\Collection $stafftasks
 * @property \Illuminate\Database\Eloquent\Collection $standardtasks
 * @property \Illuminate\Database\Eloquent\Collection $standardtask2s
 * @property integer $reportsto
 * @property string $firstname
 * @property string $lastname
 * @property string $staff_role
 * @property string $contactnumber
 * @property string $email
 * @property string $startdate
 */
class StaffMember extends Model
{
    use SoftDeletes;

    use HasFactory;

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

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
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

    /**
     * Validation rules
     *
     * @var array
     */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function reportsto()
    {
        return $this->belongsTo(\App\Models\Role::class, 'reportsto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function appointments()
    {
        return $this->hasMany(\App\Models\Appointment::class, 'staffmemberid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function diagnosis()
    {
        return $this->hasMany(\App\Models\Diagnosi::class, 'lastupdatedby');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function dietaryrestrictions()
    {
        return $this->hasMany(\App\Models\Dietaryrestriction::class, 'lastupdatedby');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function doses()
    {
        return $this->hasMany(\App\Models\Dose::class, 'prescribedby');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function emergencyalerts()
    {
        return $this->hasMany(\App\Models\Emergencyalert::class, 'triggeredbyid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function emergencyalert1s()
    {
        return $this->hasMany(\App\Models\Emergencyalert::class, 'resolvedbyid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class, 'staffmemberid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stafftasks()
    {
        return $this->hasMany(\App\Models\Stafftask::class, 'staffmemberid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function standardtasks()
    {
        return $this->hasMany(\App\Models\Standardtask::class, 'assignedto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function standardtask2s()
    {
        return $this->hasMany(\App\Models\Standardtask::class, 'completedby');
    }
}
