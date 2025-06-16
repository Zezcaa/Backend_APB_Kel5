<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('hasil_periksas', function (Blueprint $table) {
        $table->unsignedBigInteger('doctor_id')->nullable()->after('patient_id');

        // Kalau ingin pakai foreign key:
        // $table->foreign('doctor_id')->references('id')->on('users')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('hasil_periksas', function (Blueprint $table) {
        // drop foreign key dulu kalau ada
        // $table->dropForeign(['doctor_id']);

        $table->dropColumn('doctor_id');
    });
}

};
