<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class staff_profiles
 * @package App\Models
 * @version April 7, 2025, 5:37 pm UTC
 *
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $phone
 * @property string $staff_role
 * @property string $profile_picture
 * @property string $bio
 */
class staff_profiles extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'staff_profiles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'email',
        'phone',
        'staff_role',
        'profile_picture',
        'bio'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'firstname' => 'string',
        'lastname' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'staff_role' => 'string',
        'profile_picture' => 'string',
        'bio' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'nullable',
        'firstname' => 'required|string|max:100',
        'lastname' => 'required|string|max:100',
        'email' => 'required|string|max:150',
        'phone' => 'nullable|string|max:20',
        'staff_role' => 'required|string|max:50',
        'profile_picture' => 'nullable|string|max:255',
        'bio' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
