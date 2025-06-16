<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel profiles.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi dengan tabel users
            $table->string('full_name');
            $table->text('address')->nullable();
            $table->date('birthdate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migration untuk menghapus tabel profiles.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
