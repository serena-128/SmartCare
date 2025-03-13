<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class careplan
 * @package App\Models
 * @version February 12, 2025, 9:34 pm UTC
 *
 * @property \App\Models\Resident $residentid
 * @property \App\Models\Role $roleid
 * @property integer $residentid
 * @property integer $roleid
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
        'caregoals' => 'nullable|string|max:100',
        'caretreatment' => 'nullable|string|max:100',
        'notes' => 'nullable|string|max:200',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
public function resident()
{
    return $this->belongsTo(Resident::class, 'residentid');
}


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function roleid()
    {
        return $this->belongsTo(\App\Models\Role::class, 'roleid');
    }
}
