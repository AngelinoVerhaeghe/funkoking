<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_categories')->insert(['name' => 'Funko Pop', 'slug' => 'funko-pop', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('blog_categories')->insert(['name' => 'Actie Figuren', 'slug' => 'actie-figuren', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('blog_categories')->insert(['name' => 'Sleutelhangers', 'slug' => 'sleutelhangers', 'created_at' => now(), 'updated_at' => now()]);
    }
}
