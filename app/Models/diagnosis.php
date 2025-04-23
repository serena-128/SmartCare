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
    public static $rules = [
    'residentid'     => 'required|exists:resident,id',
    'diagnosis'      => 'required|string|max:255',
    'vitalsigns'     => 'nullable|string|max:255',
    'treatment'      => 'nullable|string|max:255',
    'testresults'    => 'nullable|string|max:255',
    'notes'          => 'nullable|string|max:1000',
    'lastupdatedby'  => 'required|exists:staffmember,id'
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

