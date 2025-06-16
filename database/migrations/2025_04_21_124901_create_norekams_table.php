<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNorekamsTable extends Migration
{
    public function up(): void
    {
        Schema::create('norekams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('dokter_id');
            $table->string('Diagnosa', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('norekams');
    }
}

