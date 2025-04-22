<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
    'message',
    'sender',
    'recipient',
    'nextofkin_id', // Make sure this exists
    'caregiver_id',
];

public function nextOfKin()
{
    return $this->belongsTo(\App\Models\NextOfKin::class, 'nextofkin_id');
}


}

