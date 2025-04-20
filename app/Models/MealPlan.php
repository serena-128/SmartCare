<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    protected $fillable = [
      'resident_id','plan_date','meals','created_by','updated_by'
    ];

    protected $casts = [
      'meals' => 'array',
      'plan_date' => 'date',
    ];

    public function resident()
    {
      return $this->belongsTo(Resident::class);
    }
}
