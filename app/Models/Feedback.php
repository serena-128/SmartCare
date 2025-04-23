<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class feedback
 * @package App\Models
 * @version April 23, 2025, 11:11 pm UTC
 *
 * @property \App\Models\Staffmember $staff
 * @property integer $staff_id
 * @property string $category
 * @property string $subject
 * @property string $message
 * @property boolean $rating
 * @property string $attachment
 * @property boolean $is_anonymous
 */
class feedback extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'feedback';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'staff_id',
        'category',
        'subject',
        'message',
        'rating',
        'attachment',
        'is_anonymous'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'staff_id' => 'integer',
        'category' => 'string',
        'subject' => 'string',
        'message' => 'string',
        'rating' => 'boolean',
        'attachment' => 'string',
        'is_anonymous' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'staff_id' => 'nullable|integer',
        'category' => 'required|string|max:100',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
        'rating' => 'nullable|boolean',
        'attachment' => 'nullable|string|max:255',
        'is_anonymous' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function staff()
    {
        return $this->belongsTo(\App\Models\Staffmember::class, 'staff_id');
    }
}
