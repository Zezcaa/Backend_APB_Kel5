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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('speciality');
            $table->string('photo_path');
            $table->unsignedBigInteger('clinic_id');  // Menambahkan kolom foreign key
            $table->string('username')->unique(); 
            $table->string('password');

            $table->timestamps();
    
            // Menambahkan foreign key constraint
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
