<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class MealPlanEntry extends Model
{
    protected $fillable = [
      'meal_plan_id','category','name','quantity','consumed'
    ];

    public function plan()
    {
        return $this->belongsTo(MealPlan::class, 'meal_plan_id');
    }
}
