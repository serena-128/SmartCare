<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'schedule';

    protected $fillable = [
        'roleid',
        'staffmemberid',
        'shiftdate',
        'starttime',
        'endtime',
        'shifttype',
    ];

    protected $casts = [
        'id' => 'integer',
        'roleid' => 'integer',
        'staffmemberid' => 'integer',
        'shiftdate' => 'date',
        'shifttype' => 'string',
    ];

    /**
     * Relationship with StaffMember
     */
    public function staffmember()
    {
        return $this->belongsTo(StaffMember::class, 'staffmemberid', 'id');
    }

    /**
     * Relationship with Role
     */
    //public function role()
    //{
    //    return $this->belongsTo(Role::class, 'roleid', 'id');
    //}
}
