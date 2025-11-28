<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlanEntry extends Model
{
    protected $fillable = [
        'meal_plan_id',
        'day_of_week',
        'meal_type',
        'recipe_id'
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function plan()
    {
        return $this->belongsTo(MealPlan::class, 'meal_plan_id');
    }
}
