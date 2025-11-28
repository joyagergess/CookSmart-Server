<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
   public function up(){
    Schema::create('meal_plans', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('household_id');
        $table->date('week_start_date');
        $table->timestamps();

        $table->foreign('household_id')
              ->references('id')
              ->on('households')
              ->onDelete('cascade');
    });
}


   
    public function down(): void
    {
        Schema::dropIfExists('meal_plans');
    }
};
