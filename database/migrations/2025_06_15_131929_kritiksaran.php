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
        Schema::create('kritiksaran', function (Blueprint $table) {
            $table->id();               // Kolom ID sebagai primary key
            $table->text('pesan');     // Kolom isi pesan
            $table->timestamps();      // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kritiksaran');
    }
};
