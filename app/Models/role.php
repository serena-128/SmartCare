<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class role
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
class role extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'role';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'firstname',
        'lastname',
        'roletype',
        'contactnumber',
        'email',
        'employmentstartdate'
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
        'employmentstartdate' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'firstname' => 'nullable|string|max:50',
        'lastname' => 'nullable|string|max:50',
        'roletype' => 'nullable|string|max:50',
        'contactnumber' => 'nullable|string|max:15',
        'email' => 'nullable|string|max:100',
        'employmentstartdate' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function careplans()
    {
        return $this->hasMany(\App\Models\Careplan::class, 'roleid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class, 'roleid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function staffmembers()
    {
        return $this->hasMany(\App\Models\Staffmember::class, 'reportsto');
    }
}
