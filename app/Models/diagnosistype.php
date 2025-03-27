<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class diagnosistype
 * @package App\Models
 * @version March 25, 2025, 6:17 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $residentDiagnosis
 * @property string $name
 * @property string $description
 */
class diagnosistype extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'diagnosistype';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'nullable|string|max:100',
        'description' => 'nullable|string|max:255'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function residentDiagnosis()
    {
        return $this->hasMany(\App\Models\ResidentDiagnosi::class, 'diagnosistypeid');
    }
    public function residents()
{
    return $this->belongsToMany(Resident::class, 'resident_diagnosis')
        ->withPivot(['vitalsigns', 'treatment', 'testresults', 'notes', 'lastupdatedby'])
        ->withTimestamps();
}

}
