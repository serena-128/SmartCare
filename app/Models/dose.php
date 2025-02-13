<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class dose
 * @package App\Models
 * @version February 12, 2025, 9:31 pm UTC
 *
 * @property \App\Models\Resident $residentid
 * @property \App\Models\Staffmember $prescribedby
 * @property integer $residentid
 * @property string $name
 * @property string $dosage
 * @property string $frequency
 * @property string $startdate
 * @property string $enddate
 * @property integer $prescribedby
 * @property string $notes
 */
class dose extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'dose';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'residentid',
        'name',
        'dosage',
        'frequency',
        'startdate',
        'enddate',
        'prescribedby',
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
        'name' => 'string',
        'dosage' => 'string',
        'frequency' => 'string',
        'startdate' => 'date',
        'enddate' => 'date',
        'prescribedby' => 'integer',
        'notes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'residentid' => 'nullable|integer',
        'name' => 'nullable|string|max:50',
        'dosage' => 'nullable|string|max:50',
        'frequency' => 'nullable|string|max:50',
        'startdate' => 'nullable',
        'enddate' => 'nullable',
        'prescribedby' => 'nullable|integer',
        'notes' => 'nullable|string|max:50',
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
    public function prescribedby()
    {
        return $this->belongsTo(\App\Models\Staffmember::class, 'prescribedby');
    }
}
