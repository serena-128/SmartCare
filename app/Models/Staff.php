<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staffmember'; // Add this line
    
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'staff_role',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}