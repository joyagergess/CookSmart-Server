<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('pantry_items', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('household_id')
                  ->constrained('households')
                  ->cascadeOnDelete();

            $table->foreignId('ingredient_id')
                  ->constrained('ingredients')
                  ->cascadeOnDelete();

            $table->decimal('quantity', 10, 2);
            $table->string('unit', 20)->nullable();
            $table->date('expiry_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pantry_items');
    }
};
