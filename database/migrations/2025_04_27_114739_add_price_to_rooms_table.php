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
        Schema::table('rooms', function (Blueprint $table) {
            $table->decimal('price', 10, 2); // Menambahkan kolom harga
        });
    }
    
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('price'); // Menghapus kolom harga jika rollback migrasi
        });
    }
    
};
