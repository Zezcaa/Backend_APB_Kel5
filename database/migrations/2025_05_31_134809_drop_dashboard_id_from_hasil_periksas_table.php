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
            // Nama foreign key biasanya format: tabel_kolom_foreign
            // Tapi untuk pastinya, cek dulu di DB atau pakai command SHOW CREATE TABLE hasil_periksas;
    
            $table->dropForeign(['dashboard_id']);  // drop foreign key constraint dulu
            $table->dropColumn('dashboard_id');     // baru drop kolom
        });
    }
    
    public function down()
    {
        Schema::table('hasil_periksas', function (Blueprint $table) {
            $table->unsignedBigInteger('dashboard_id')->nullable();
    
            // Jika ingin restore foreign key:
            // $table->foreign('dashboard_id')->references('id')->on('dashboards')->onDelete('set null');
        });
    }
    

};
