<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class nextofkin
 * @package App\Models
 * @version February 12, 2025, 8:22 pm UTC
 *
 * @property \App\Models\Resident $residentid
 * @property integer $residentid
 * @property string $firstname
 * @property string $lastname
 * @property string $relationshiptoresident
 * @property string $contactnumber
 * @property string $email
 * @property string $address
 */
class nextofkin extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'nextofkin';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'residentid',
        'firstname',
        'lastname',
        'relationshiptoresident',
        'contactnumber',
        'email',
        'address',
        'password'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'id' => 'integer',
        'residentid' => 'integer',
        'firstname' => 'string',
        'lastname' => 'string',
        'relationshiptoresident' => 'string',
        'contactnumber' => 'string',
        'email' => 'string',
        'address' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'residentid' => 'nullable|integer',
        'firstname' => 'nullable|string|max:50',
        'lastname' => 'nullable|string|max:50',
        'relationshiptoresident' => 'nullable|string|max:100',
        'contactnumber' => 'nullable|string|max:15',
        'email' => 'nullable|string|max:100',
        'address' => 'nullable|string|max:100',
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
}
