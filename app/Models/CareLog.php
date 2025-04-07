<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CareLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'caregiver_id',
        'caregiver_name',
        'caregiver_type',
        'activity_type',
        'notes',
        'logged_at',
    ];

    protected $dates = ['logged_at'];

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }

    public function caregiver(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class, 'caregiver_id');
    }
}
