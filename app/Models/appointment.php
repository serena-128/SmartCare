<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class appointment
 * @package App\Models
 * @version February 12, 2025, 9:29 pm UTC
 *
 * @property \App\Models\Resident $residentid
 * @property \App\Models\Staffmember $staffmemberid
 * @property integer $residentid
 * @property integer $staffmemberid
 * @property string $date
 * @property time $time
 * @property string $reason
 * @property string $location
 */
class appointment extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'appointment';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'residentid',
        'staffmemberid',
        'date',
        'time',
        'reason',
        'location'
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
        'date' => 'date',
        'reason' => 'string',
        'location' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'residentid' => 'nullable|integer',
        'staffmemberid' => 'nullable|integer',
        'date' => 'nullable',
        'time' => 'nullable',
        'reason' => 'nullable|string|max:100',
        'location' => 'nullable|string|max:100',
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
    public function staffmemberid()
    {
        return $this->belongsTo(\App\Models\Staffmember::class, 'staffmemberid');
    }
}
