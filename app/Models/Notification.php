<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['nextofkin_id', 'message', 'is_read'];

    public function nextOfKin()
    {
        return $this->belongsTo(NextOfKin::class, 'nextofkin_id');
    }
}
