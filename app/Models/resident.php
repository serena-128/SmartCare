<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class resident
 * @package App\Models
 * @version February 11, 2025, 11:35 am UTC
 *
 * @property string $firstname
 * @property string $lastname
 * @property string $dateofbirth
 * @property string $gender
 * @property integer $roomnumber
 * @property string $admissiondate
 */
class resident extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'resident';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'firstname',
        'lastname',
        'dateofbirth',
        'gender',
        'roomnumber',
        'admissiondate'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'residentid' => 'integer',
        'firstname' => 'string',
        'lastname' => 'string',
        'dateofbirth' => 'date',
        'gender' => 'string',
        'roomnumber' => 'integer',
        'admissiondate' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'firstname' => 'nullable|string|max:50',
        'lastname' => 'nullable|string|max:50',
        'dateofbirth' => 'nullable',
        'gender' => 'nullable|string|max:20',
        'roomnumber' => 'nullable|integer',
        'admissiondate' => 'nullable'
    ];

    
}
