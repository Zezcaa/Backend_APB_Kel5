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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id'); // Foreign key untuk dokter
            $table->string('day'); // Hari praktek
            $table->string('time'); // Waktu praktek
            $table->timestamps();
        
            // Relasi dengan tabel doctors
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
