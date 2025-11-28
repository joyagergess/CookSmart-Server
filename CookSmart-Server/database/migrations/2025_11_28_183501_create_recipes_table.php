<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('household_id')->nullable(); 
            $table->string('title', 150);
            $table->text('instructions')->nullable();
            $table->unsignedBigInteger('created_by'); 
            $table->timestamps();

            $table->foreign('household_id')
                ->references('id')
                ->on('households')
                ->nullOnDelete();

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
