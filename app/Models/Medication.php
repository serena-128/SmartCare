<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    // Define which fields are mass assignable
    protected $fillable = [
        'resident_id', 'medication_name', 'scheduled_time', 'taken'
    ];

    // Define the relationship with the Resident model
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
