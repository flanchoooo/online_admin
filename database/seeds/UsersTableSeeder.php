<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('users')->delete();

        \App\User::create([
            'name'     => 'Dean Tawonezvi',
            'email'    => 'deantawonezvi1@gmail.com',
            'password' => bcrypt('D34n#1993'),
            'mobile'   => '263772240291',
            'verified'=>1
        ]);
        \App\User::create([
            'name'     => 'Test',
            'email'    => 'test@gmail.com',
            'password' => bcrypt('12345'),
            'mobile'   => '263772240290',
            'verified'=>1

        ]);
    }
}
