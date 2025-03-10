<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class schedule
 * @package App\Models
 * @version March 10, 2025, 9:45 am UTC
 *
 * @property \App\Models\Role $roleid
 * @property \App\Models\Staffmember $staffmemberid
 * @property \App\Models\Staffmember $approvedBy
 * @property integer $roleid
 * @property integer $staffmemberid
 * @property string $shiftdate
 * @property time $starttime
 * @property time $endtime
 * @property string $shifttype
 * @property integer $requested_shift_id
 * @property string $shift_status
 * @property string $request_reason
 * @property integer $approved_by
 */
class schedule extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'schedule';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'roleid',
        'staffmemberid',
        'shiftdate',
        'starttime',
        'endtime',
        'shifttype',
        'requested_shift_id',
        'shift_status',
        'request_reason',
        'approved_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'roleid' => 'integer',
        'staffmemberid' => 'integer',
        'shiftdate' => 'date',
        'shifttype' => 'string',
        'requested_shift_id' => 'integer',
        'shift_status' => 'string',
        'request_reason' => 'string',
        'approved_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'roleid' => 'nullable|integer',
        'staffmemberid' => 'nullable|integer',
        'shiftdate' => 'nullable',
        'starttime' => 'nullable',
        'endtime' => 'nullable',
        'shifttype' => 'nullable|string|max:50',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'requested_shift_id' => 'nullable|integer',
        'shift_status' => 'nullable|string',
        'request_reason' => 'nullable|string',
        'approved_by' => 'nullable|integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function roleid()
    {
        return $this->belongsTo(\App\Models\Role::class, 'roleid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function staffmemberid()
    {
        return $this->belongsTo(\App\Models\Staffmember::class, 'staffmemberid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function approvedBy()
    {
        return $this->belongsTo(\App\Models\Staffmember::class, 'approved_by');
    }
}
