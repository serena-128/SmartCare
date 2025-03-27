<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NextOfKin extends Authenticatable
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
        'password',
        'profile_picture'       
    ];

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

   
        public function resident()
    {
        return $this->belongsTo(\App\Models\Resident::class, 'residentid');
    }
    

}
