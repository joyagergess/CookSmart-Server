<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('shopping_list_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shopping_list_id');
            $table->unsignedBigInteger('ingredient_id');
            $table->decimal('quantity_needed', 10, 2);
            $table->string('unit', 20);
            $table->boolean('is_bought')->default(false);
            $table->timestamps();
       
            $table->foreign('shopping_list_id')
                  ->references('id')->on('shopping_lists')
                  ->onDelete('cascade');
       
            $table->foreign('ingredient_id')
                  ->references('id')->on('ingredients')
                  ->onDelete('cascade');
       });

    }

    public function down(): void
    {
        Schema::dropIfExists('shopping_list_items');
    }
};
