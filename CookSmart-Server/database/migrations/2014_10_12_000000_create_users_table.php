<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_type_id')
                  ->default(2) 
                  ->constrained('user_types')
                  ->restrictOnDelete();

            $table->string('name', 100);
            $table->string('email', 255)->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};
