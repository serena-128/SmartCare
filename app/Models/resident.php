<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Resident
 * @package App\Models
 * @version February 11, 2025, 11:35 am UTC
 *
 * @property string $firstname
 * @property string $lastname
 * @property string $dateofbirth
 * @property string $gender
 * @property integer $roomnumber
 * @property string $admissiondate
 * @property string $medical_history
 * @property string $allergies
 * @property string $medications
 * @property string $doctor_notes
 */
class Resident extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'resident'; // Ensure it matches the database table name

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
        'id' => 'integer',  // Ensure correct primary key reference
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

    public function emergencyAlerts()
    {
        return $this->hasMany(\App\Models\EmergencyAlert::class, 'resident_id', 'id'); // Ensure correct foreign key
    }

    /**
     * Accessor: Get the full name of the resident
     */
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
    
    // ✅ Add relationship with Diagnosis
    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class, 'residentid');
    }

    public function diagnosistypes()
    {
        return $this->belongsToMany(DiagnosisType::class, 'resident_diagnosis')
            ->withPivot(['vitalsigns', 'treatment', 'testresults', 'notes', 'lastupdatedby'])
            ->withTimestamps();
    }

    // ✅ Add relationship with Medications
    public function medications()
    {
        return $this->hasMany(Medication::class);
    }
}


