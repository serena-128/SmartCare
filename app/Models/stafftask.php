<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class stafftask
 * @package App\Models
 * @version February 13, 2025, 9:40 am UTC
 *
 * @property \App\Models\Staffmember $staffmemberid
 * @property \App\Models\Standardtask $taskid
 * @property integer $staffmemberid
 * @property integer $taskid
 * @property string $roleintask
 * @property string $startdate
 * @property string $enddate
 */
class stafftask extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'stafftask';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'staffmemberid',
        'taskid',
        'roleintask',
        'startdate',
        'enddate'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'staffmemberid' => 'integer',
        'taskid' => 'integer',
        'roleintask' => 'string',
        'startdate' => 'date',
        'enddate' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'staffmemberid' => 'nullable|integer',
        'taskid' => 'nullable|integer',
        'roleintask' => 'nullable|string|max:100',
        'startdate' => 'nullable',
        'enddate' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

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
    public function taskid()
    {
        return $this->belongsTo(\App\Models\Standardtask::class, 'taskid');
    }
}
