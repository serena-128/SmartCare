<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnosis extends Model
{
    use SoftDeletes;

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
}

