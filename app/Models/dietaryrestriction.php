<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class dietaryrestriction
 * @package App\Models
 * @version February 12, 2025, 9:36 pm UTC
 *
 * @property \App\Models\Resident $residentid
 * @property \App\Models\Staffmember $lastupdatedby
 * @property integer $residentid
 * @property string $foodrestrictions
 * @property string $foodpreferences
 * @property string $allergies
 * @property string $notes
 * @property integer $lastupdatedby
 */
class dietaryrestriction extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'dietaryrestriction';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'residentid',
        'foodrestrictions',
        'foodpreferences',
        'allergies',
        'notes',
        'lastupdatedby'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'residentid' => 'integer',
        'foodrestrictions' => 'string',
        'foodpreferences' => 'string',
        'allergies' => 'string',
        'notes' => 'string',
        'lastupdatedby' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'residentid' => 'nullable|integer',
        'foodrestrictions' => 'nullable|string|max:100',
        'foodpreferences' => 'nullable|string|max:100',
        'allergies' => 'nullable|string|max:100',
        'notes' => 'nullable|string|max:200',
        'lastupdatedby' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function residentid()
    {
        return $this->belongsTo(\App\Models\Resident::class, 'residentid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function lastupdatedby()
    {
        return $this->belongsTo(\App\Models\Staffmember::class, 'lastupdatedby');
    }
}
