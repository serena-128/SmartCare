<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class standardtask
 * @package App\Models
 * @version February 12, 2025, 9:35 pm UTC
 *
 * @property \App\Models\Staffmember $assignedto
 * @property \App\Models\Staffmember $completedby
 * @property \Illuminate\Database\Eloquent\Collection $stafftasks
 * @property integer $assignedto
 * @property string $description
 * @property string $duedate
 * @property string $prioritylevel
 * @property integer $completedby
 * @property string|\Carbon\Carbon $completiondatetime
 */
class standardtask extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'standardtask';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'assignedto',
        'description',
        'duedate',
        'prioritylevel',
        'completedby',
        'completiondatetime'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'assignedto' => 'integer',
        'description' => 'string',
        'duedate' => 'date',
        'prioritylevel' => 'string',
        'completedby' => 'integer',
        'completiondatetime' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'assignedto' => 'nullable|integer',
        'description' => 'nullable|string|max:200',
        'duedate' => 'nullable',
        'prioritylevel' => 'nullable|string|max:20',
        'completedby' => 'nullable|integer',
        'completiondatetime' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function assignedto()
    {
        return $this->belongsTo(\App\Models\Staffmember::class, 'assignedto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function completedby()
    {
        return $this->belongsTo(\App\Models\Staffmember::class, 'completedby');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stafftasks()
    {
        return $this->hasMany(\App\Models\Stafftask::class, 'taskid');
    }
}
