<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class careplan
 * @package App\Models
 * @version February 24, 2025, 10:30 pm UTC
 *
 * @property integer $residentid
 * @property integer $roleid
 * @property string $medical_history
 * @property string $medications
 * @property string $dietary_preferences
 * @property string $treatments
 * @property string $preferences
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
        'roleid',
        'medical_history',
        'medications',
        'dietary_preferences',
        'treatments',
        'preferences',
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
        'roleid' => 'integer',
        'medical_history' => 'string',
        'medications' => 'string',
        'dietary_preferences' => 'string',
        'treatments' => 'string',
        'preferences' => 'string',
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
        'residentid' => 'nullable|integer',
        'roleid' => 'nullable|integer',
        'medical_history' => 'nullable|string',
        'medications' => 'nullable|string',
        'dietary_preferences' => 'nullable|string',
        'treatments' => 'nullable|string',
        'preferences' => 'nullable|string',
        'caregoals' => 'nullable|string',
        'caretreatment' => 'nullable|string',
        'notes' => 'nullable|string',
        'created_at' => 'required',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
