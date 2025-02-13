<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyAlert extends Model {
    use HasFactory;

    protected $fillable = [
        'residentid', 'triggeredbyid', 'alerttype', 'alerttimestamp', 'status', 'resolvedbyid'
    ];

    // Relationship with Resident
    public function resident() {
        return $this->belongsTo(Resident::class, 'residentid');
    }

    // Relationship with StaffMember (who triggered the alert)
    public function triggeredBy() {
        return $this->belongsTo(StaffMember::class, 'triggeredbyid');
    }

    // Relationship with StaffMember (who resolved the alert)
    public function resolvedBy() {
        return $this->belongsTo(StaffMember::class, 'resolvedbyid');
    }
}
