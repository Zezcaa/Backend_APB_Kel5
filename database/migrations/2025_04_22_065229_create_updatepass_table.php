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
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            // Hash ulang password dengan SHA-256 jika belum di-hash
            $hashedPassword = hash('sha256', $user->password);
            DB::table('users')
                ->where('id', $user->id)
                ->update(['password' => $hashedPassword]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
