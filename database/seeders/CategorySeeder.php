<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
           'title'=>'Hot deals'
        ]);
        DB::table('categories')->insert([
           'title'=>'Laptops'
        ]);
        DB::table('categories')->insert([
           'title'=>'Smartphones'
        ]);
        DB::table('categories')->insert([
           'title'=>'Cameras'
        ]);
        DB::table('categories')->insert([
           'title'=>'Accessories'
        ]);
    }
}
