<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    protected $fillable = ['household_id', 'week_start_date'];

    public function entries()
    {
        return $this->hasMany(MealPlanEntry::class);
    }
}
