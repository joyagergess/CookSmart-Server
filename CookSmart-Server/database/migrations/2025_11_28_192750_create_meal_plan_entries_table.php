<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(){
    Schema::create('meal_plan_entries', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('meal_plan_id');
        $table->smallInteger('day_of_week');
        $table->enum('meal_type', ['breakfast','lunch','dinner','snack']);
        $table->unsignedBigInteger('recipe_id')->nullable();
        $table->timestamps();

        $table->foreign('meal_plan_id')
              ->references('id')
               ->on('meal_plans')
               ->onDelete('cascade');

        $table->foreign('recipe_id')
              ->references('id')
              ->on('recipes')
              ->onDelete('set null');
    });
   }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_plan_entries');
    }
};
