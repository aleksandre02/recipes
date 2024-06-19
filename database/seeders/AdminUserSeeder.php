<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'bali',
            'email' => 'bali@gmail.com',
            'password' => Hash::make('bali1234'),
            'privileges' => 'admin',
            'is_admin' => true,
        ]);
    }
}
