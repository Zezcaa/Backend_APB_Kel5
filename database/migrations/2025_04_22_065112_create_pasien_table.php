<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name');
            $table->integer('age')->nullable(); // Optional for existing patients
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('birth_date')->nullable();
            $table->string('medical_record_number')->nullable(); // Only for existing patients
            $table->string('queue_number')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // Queue Number
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
