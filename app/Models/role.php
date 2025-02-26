<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role
 * @package App\Models
 * @version February 12, 2025, 7:57 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $careplans
 * @property \Illuminate\Database\Eloquent\Collection $schedules
 * @property \Illuminate\Database\Eloquent\Collection $staffmembers
 * @property string $name
 * @property string $firstname
 * @property string $lastname
 * @property string $roletype
 * @property string $contactnumber
 * @property string $email
 * @property string $employmentstartdate
 */
class Role extends Model
{
<<<<<<< HEAD
    use SoftDeletes, HasFactory;

    // The name of the table associated with the model
    protected $table = 'roles'; // Ensure your table is named correctly

=======
    use SoftDeletes;
    use HasFactory;

    // The name of the table associated with the model
    public $table = 'roles'; // Ensure your table is named 'roles', or adjust if necessary
    
>>>>>>> 0662733a93f9a5b73408ffe645d4c75a8f334092
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    // Fillable fields
<<<<<<< HEAD
    protected $fillable = [
        'name', // Added 'name' from the local version
=======
    public $fillable = [
>>>>>>> 0662733a93f9a5b73408ffe645d4c75a8f334092
        'firstname',
        'lastname',
        'roletype',
        'contactnumber',
        'email',
        'employmentstartdate',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'firstname' => 'string',
        'lastname' => 'string',
        'roletype' => 'string',
        'contactnumber' => 'string',
        'email' => 'string',
        'employmentstartdate' => 'date',
    ];

    /**
<<<<<<< HEAD
     * Many-to-Many Relationship: Role belongs to many Users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * One-to-Many Relationship: Get the care plans for this role.
     */
    public function careplans()
    {
        return $this->hasMany(\App\Models\CarePlan::class, 'role_id'); // Ensure 'role_id' is the correct foreign key
    }

    /**
     * One-to-Many Relationship: Get the schedules for this role.
     */
    public function schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class, 'role_id'); // Ensure 'role_id' is the correct foreign key
    }

    /**
     * One-to-Many Relationship: Get the staff members under this role.
     */
    public function staffmembers()
    {
        return $this->hasMany(\App\Models\StaffMember::class, 'role_id'); // Ensure 'role_id' is the correct foreign key
=======
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
>>>>>>> 0662733a93f9a5b73408ffe645d4c75a8f334092
    }
}
