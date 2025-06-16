<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('patients', function (Blueprint $table) {
        $table->unsignedBigInteger('doctor_id')->nullable()->after('user_id');

        // Foreign key ke tabel doctors
        $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('patients', function (Blueprint $table) {
        $table->dropForeign(['doctor_id']);
        $table->dropColumn('doctor_id');
    });
}

};
