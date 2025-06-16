<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_periksas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade'); // Relasi ke patients
            $table->foreignId('dashboard_id')->constrained('dashboards')->onDelete('cascade'); // Relasi ke dashboards
            $table->enum('jenis_rawat', ['Rawat Jalan', 'Rawat Inap'])->default('Rawat Jalan'); // Jenis rawat
            $table->string('diagnosa'); // Diagnosa pasien
            $table->text('resep'); // Resep dokter
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_periksas');
    }
};

