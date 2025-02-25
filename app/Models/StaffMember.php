<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class StaffMember
 * @package App\Models
 * @version February 25, 2025, 6:30 pm UTC
 *
 * @property integer $reportsto
 * @property string $firstname
 * @property string $lastname
 * @property string $role
 * @property string $contactnumber
 * @property string $email
 * @property string $startdate
 */
class StaffMember extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'staffmember';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'reportsto',
        'firstname',
        'lastname',
        'role',
        'contactnumber',
        'email',
        'startdate'
    ];

    protected $casts = [
        'id' => 'integer',
        'reportsto' => 'integer',
        'firstname' => 'string',
        'lastname' => 'string',
        'role' => 'string',
        'contactnumber' => 'string',
        'email' => 'string',
        'startdate' => 'date'
    ];

    public static $rules = [
        'reportsto' => 'nullable|integer',
        'firstname' => 'nullable|string|max:50',
        'lastname' => 'nullable|string|max:50',
        'role' => 'nullable|string|max:50',
        'contactnumber' => 'nullable|string|max:15',
        'email' => 'nullable|string|max:50',
        'startdate' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * Get the role type associated with this staff member.
     */
    public function roleType()
    {
        return $this->belongsTo(Role::class, 'role', 'roletype');
    }
}
