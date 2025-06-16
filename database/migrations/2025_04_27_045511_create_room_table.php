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
       // Migrasi untuk rooms
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('type');  // Tipe kamar (Standard, VIP, Suite)
            $table->string('description'); // Deskripsi kamar
            $table->string('photo_path'); // Gambar kamar
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room');
    }
};
