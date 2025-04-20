<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    protected $fillable = ['resident_id','plan_date','created_by','updated_by'];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function entries()
    {
        return $this->hasMany(MealPlanEntry::class);
    }
}
