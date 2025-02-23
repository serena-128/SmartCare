<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class medication_reminders
 * @package App\Models
 * @version February 23, 2025, 10:10 pm UTC
 *
 * @property \App\Models\Resident $resident
 * @property \App\Models\Staffmember $staffmember
 * @property integer $resident_id
 * @property integer $staffmember_id
 * @property string $medication_name
 * @property string $dosage
 * @property string $frequency
 * @property time $time_for_administration
 */
class medication_reminders extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'medication_reminders';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'resident_id',
        'staffmember_id',
        'medication_name',
        'dosage',
        'frequency',
        'time_for_administration'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'resident_id' => 'integer',
        'staffmember_id' => 'integer',
        'medication_name' => 'string',
        'dosage' => 'string',
        'frequency' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'resident_id' => 'required|integer',
        'staffmember_id' => 'required|integer',
        'medication_name' => 'required|string|max:100',
        'dosage' => 'required|string|max:50',
        'frequency' => 'required|string|max:50',
        'time_for_administration' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function resident()
    {
        return $this->belongsTo(\App\Models\Resident::class, 'resident_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function staffmember()
    {
        return $this->belongsTo(\App\Models\Staffmember::class, 'staffmember_id');
    }
}
