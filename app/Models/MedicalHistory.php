<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id', 'title', 'description', 'type',
        'diagnosed_at', 'source', 'visibility', 'added_by'
    ];

    public function resident() {
        return $this->belongsTo(Resident::class);
    }

    public function staff() {
        return $this->belongsTo(Staffmember::class, 'added_by');
    }
}
