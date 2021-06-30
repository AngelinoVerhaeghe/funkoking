<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categories')->insert(['name' => 'Games', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('sub_categories')->insert(['name' => 'Film', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('sub_categories')->insert(['name' => 'Muziek', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('sub_categories')->insert(['name' => 'Basketbal', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('sub_categories')->insert(['name' => 'Voetbal', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('sub_categories')->insert(['name' => 'Disney', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('sub_categories')->insert(['name' => 'Star Wars', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('sub_categories')->insert(['name' => 'WWE', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('sub_categories')->insert(['name' => 'Marvel', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('sub_categories')->insert(['name' => 'Animatie', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('sub_categories')->insert(['name' => 'Series', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('sub_categories')->insert(['name' => 'Televisie', 'created_at' => now(), 'updated_at' => now()]);
    }
}
