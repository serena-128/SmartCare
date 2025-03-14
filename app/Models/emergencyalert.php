<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class emergencyalert
 * @package App\Models
 * @version March 14, 2025, 1:57 am UTC
 *
 * @property \App\Models\Resident $residentid
 * @property \App\Models\Staffmember $triggeredbyid
 * @property \App\Models\Staffmember $resolvedbyid
 * @property integer $residentid
 * @property integer $triggeredbyid
 * @property string $alerttype
 * @property string|\Carbon\Carbon $alerttimestamp
 * @property string $status
 * @property integer $resolvedbyid
 */
class emergencyalert extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'emergencyalert';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'residentid',
        'triggeredbyid',
        'alerttype',
        'alerttimestamp',
        'status',
        'resolvedbyid'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'residentid' => 'integer',
        'triggeredbyid' => 'integer',
        'alerttype' => 'string',
        'alerttimestamp' => 'datetime',
        'status' => 'string',
        'resolvedbyid' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'residentid' => 'required|integer',
        'triggeredbyid' => 'required|integer',
        'alerttype' => 'required|string|max:50',
        'alerttimestamp' => 'nullable',
        'status' => 'nullable|string|max:20',
        'resolvedbyid' => 'nullable|integer',
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
    public function triggeredbyid()
    {
        return $this->belongsTo(\App\Models\Staffmember::class, 'triggeredbyid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function resolvedbyid()
    {
        return $this->belongsTo(\App\Models\Staffmember::class, 'resolvedbyid');
    }
}
