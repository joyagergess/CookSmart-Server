<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipe_ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipe_id');
            $table->unsignedBigInteger('ingredient_id');
            $table->decimal('amount', 10, 2);
            $table->string('unit', 20);
            $table->timestamps();

            $table->foreign('recipe_id')
                ->references('id')
                ->on('recipes')
                ->cascadeOnDelete();

            $table->foreign('ingredient_id')
                ->references('id')
                ->on('ingredients')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipe_ingredients');
    }
};
