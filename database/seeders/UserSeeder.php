<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        DB::table('users')->insert([
//            'name' => Str::random(6),
//            'email' => Str::random(10).'@example.com',
//            'phone' => rand(100000000000,999999999999),
//            'role'=>'user',
//            'password' => Hash::make('password'),
//        ]);
        DB::table('users')->insert([
            'name' => 'Shakhzod',
            'email' => 'shahzodrashidov0307@gmail.com',
            'phone'=>998933229074,
            'role'=>'admin',
            'password' => Hash::make('admin123')
        ]);
    }
}
