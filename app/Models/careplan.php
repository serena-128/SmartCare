<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class careplan
 * @package App\Models
 * @version February 21, 2025, 10:53 pm UTC
 *
 * @property integer $residentid
 * @property integer $roleid
 * @property string $medical_history
 * @property string $medications
 * @property string $dietary_preferences
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
        'caregoals' => 'nullable|string',
        'caretreatment' => 'nullable|string',
        'notes' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
