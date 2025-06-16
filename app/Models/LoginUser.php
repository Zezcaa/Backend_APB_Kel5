<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class LoginUser
{
    public static function findByUsername($username)
    {
        return DB::table('users')->where('username', $username)->first();
    }
}