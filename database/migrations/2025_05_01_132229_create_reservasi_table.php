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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // pastikan pakai nullable
            // $table->foreign('user_id')->references('id')->on('users'); // Tanpa constraint
            $table->foreignId('room_id')->constrained();; // Relasi ke room
            $table->date('reservation_date');
            $table->enum('payment_method', ['mandiri', 'asuransi', 'bpjs']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};


