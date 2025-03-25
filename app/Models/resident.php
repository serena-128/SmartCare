<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resident extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'resident';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'firstname',
        'lastname',
        'dateofbirth',
        'gender',
        'roomnumber',
        'admissiondate',
    ];

    protected $casts = [
        'id' => 'integer',
        'firstname' => 'string',
        'lastname' => 'string',
        'dateofbirth' => 'date',
        'gender' => 'string',
        'roomnumber' => 'integer',
        'admissiondate' => 'date',
    ];

    public static $rules = [
        'firstname' => 'required|string|max:50',
        'lastname' => 'required|string|max:50',
        'dateofbirth' => 'required|date',
        'gender' => 'nullable|string|max:20',
        'roomnumber' => 'nullable|integer',
        'admissiondate' => 'nullable|date',
    ];

    /**
     * Relationship: Emergency Alerts
     */
    public function emergencyAlerts()
    {
        return $this->hasMany(EmergencyAlert::class, 'residentid');
    }

    /**
     * Relationship: (Legacy, if still needed)
     */
    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class, 'residentid');
    }

    /**
     * Many-to-Many: Diagnosistypes (pivot: resident_diagnosis)
     */
    public function diagnosistypes()
    {
        return $this->belongsToMany(DiagnosisType::class, 'resident_diagnosis')
            ->withPivot(['vitalsigns', 'treatment', 'testresults', 'notes', 'lastupdatedby'])
            ->withTimestamps();
    }

    /**
     * Accessor: Full name (Firstname + Lastname)
     */
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
}
