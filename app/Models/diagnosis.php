<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class diagnosis
 * @package App\Models
 * @version February 25, 2025, 6:32 pm UTC
 *
 * @property integer $residentid
 * @property string $diagnosis
 * @property string $vitalsigns
 * @property string $treatment
 * @property string $testresults
 * @property string $notes
 * @property integer $lastupdatedby
 */
class diagnosis extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'diagnosis';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'residentid',
        'diagnosis',
        'vitalsigns',
        'treatment',
        'testresults',
        'notes',
        'lastupdatedby'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'residentid' => 'integer',
        'diagnosis' => 'string',
        'vitalsigns' => 'string',
        'treatment' => 'string',
        'testresults' => 'string',
        'notes' => 'string',
        'lastupdatedby' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'residentid' => 'nullable|integer',
        'diagnosis' => 'nullable|string|max:100',
        'vitalsigns' => 'nullable|string|max:100',
        'treatment' => 'nullable|string|max:200',
        'testresults' => 'nullable|string|max:200',
        'notes' => 'nullable|string|max:200',
        'lastupdatedby' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
