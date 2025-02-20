<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CarePlan
 * @package App\Models
 * @version February 12, 2025, 9:34 pm UTC
 *
 * @property \App\Models\Resident $resident
 * @property \App\Models\Role $role
 * @property integer $resident_id
 * @property integer $role_id
 * @property string $caregoals
 * @property string $caretreatment
 * @property string $notes
 */
class CarePlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'careplans';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'resident_id',
        'role_id',
        'caregoals',
        'caretreatment',
        'notes'
    ];

    protected $casts = [
        'id' => 'integer',
        'resident_id' => 'integer',
        'role_id' => 'integer',
        'caregoals' => 'string',
        'caretreatment' => 'string',
        'notes' => 'string'
    ];

    public static $rules = [
        'resident_id' => 'nullable|integer',
        'role_id' => 'nullable|integer',
        'caregoals' => 'nullable|string|max:100',
        'caretreatment' => 'nullable|string|max:100',
        'notes' => 'nullable|string|max:200',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * Get the resident associated with this care plan.
     */
    public function resident()
    {
        return $this->belongsTo(\App\Models\Resident::class, 'resident_id');
    }

    /**
     * Get the role associated with this care plan.
     */
    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class, 'role_id');
    }
}
