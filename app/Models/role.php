<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Role
 * @package App\Models
 * @version February 12, 2025, 7:57 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $careplans
 * @property \Illuminate\Database\Eloquent\Collection $schedules
 * @property \Illuminate\Database\Eloquent\Collection $staffmembers
 * @property string $firstname
 * @property string $lastname
 * @property string $roletype
 * @property string $contactnumber
 * @property string $email
 * @property string $employmentstartdate
 */
class Role extends Model
{
    use SoftDeletes;
    use HasFactory;

    // The name of the table associated with the model
    public $table = 'roles'; // Ensure your table is named 'roles', or adjust if necessary
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    // Fillable fields
    public $fillable = [
        'firstname',
        'lastname',
        'roletype',
        'contactnumber',
        'email',
        'employmentstartdate',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'firstname' => 'string',
        'lastname' => 'string',
        'roletype' => 'string',
        'contactnumber' => 'string',
        'email' => 'string',
        'employmentstartdate' => 'date',
    ];

    /**
     * Get the care plans for this role.
     */
    public function careplans()
    {
        return $this->hasMany(\App\Models\CarePlan::class, 'role_id'); // Make sure 'role_id' is the correct foreign key
    }

    /**
     * Get the schedules for this role.
     */
    public function schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class, 'role_id'); // Make sure 'role_id' is the correct foreign key
    }

    /**
     * Get the staff members under this role.
     */
    public function staffmembers()
    {
        return $this->hasMany(\App\Models\StaffMember::class, 'role_id'); // Make sure 'role_id' is the correct foreign key
    }
}
