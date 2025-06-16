<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('userdok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade'); // Relasi ke doctors
            $table->string('password'); // Simpan password
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('userdok');
    }
};

