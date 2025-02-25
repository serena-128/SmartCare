<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'role'; // Ensure the correct table name

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    /**
     * Relationship: Role belongs to many Users (Many-to-Many)
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
