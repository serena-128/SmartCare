<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class careplan
 * @package App\Models
 * @version March 13, 2025, 11:17 pm UTC
 *
 * @property \App\Models\Resident $residentid
 * @property \App\Models\Staffmember $staffmemberid
 * @property integer $residentid
 * @property integer $staffmemberid
 * @property string $caregoals
 * @property string $caretreatment
 * @property string $notes
 */
class careplan extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'careplan';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'residentid',
        'staffmemberid',
        'caregoals',
        'caretreatment',
        'notes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'residentid' => 'integer',
        'staffmemberid' => 'integer',
        'caregoals' => 'string',
        'caretreatment' => 'string',
        'notes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'residentid' => 'required|integer',
        'staffmemberid' => 'nullable|integer',
        'caregoals' => 'nullable|string|max:100',
        'caretreatment' => 'nullable|string|max:100',
        'notes' => 'nullable|string|max:200',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
// CarePlan.php
public function resident()
{
    return $this->belongsTo(Resident::class, 'residentid');
}

public function staffmember()
{
    return $this->belongsTo(\App\Models\StaffMember::class, 'staffmemberid'); // assuming you renamed roleid to staffmemberid
}

}
