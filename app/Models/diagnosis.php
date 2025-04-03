<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    // Explicitly define the correct table name
    protected $table = 'diagnosis'; 

    protected $fillable = [
        'residentid',
        'diagnosis',
        'vitalsigns',
        'treatment',
        'testresults',
        'notes',
        'lastupdatedby'
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'residentid');
    }

    public function lastUpdatedBy()
    {
        return $this->belongsTo(StaffMember::class, 'lastupdatedby');
    }
}

