<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlanEntry extends Model
{
    protected $fillable = [
    'meal_plan_id',
    'resident_id',
    'time',
    'consumed',
    'notes',
];


    public function plan()
    {
        return $this->belongsTo(MealPlan::class, 'meal_plan_id');
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
