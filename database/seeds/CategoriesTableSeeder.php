<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(['name' => 'Funko Pop', 'slug' => 'funko-pop', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['name' => 'Actie Figuren', 'slug' => 'actie-figuren', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['name' => 'Sleutelhangers', 'slug' => 'sleutelhangers', 'created_at' => now(), 'updated_at' => now()]);
    }
}
