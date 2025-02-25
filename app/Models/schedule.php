<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class schedule
 * @package App\Models
 * @version February 25, 2025, 6:32 pm UTC
 *
 * @property integer $roleid
 * @property integer $staffmemberid
 * @property string $shiftdate
 * @property time $starttime
 * @property time $endtime
 * @property string $shifttype
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
        'shifttype'
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
        'shifttype' => 'string'
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
        'deleted_at' => 'nullable'
    ];

    
}
