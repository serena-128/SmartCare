<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stafftask extends Model
{
    use HasFactory;
    protected $table = 'stafftask'; // or 'stafftasks' if you named it plural

protected $fillable = [
    'staff_id',
    'date',
    'time',
    'description',
    
];
 public function staff()
{
    return $this->belongsTo(\App\Models\StaffMember::class, 'staff_id');
}

}
