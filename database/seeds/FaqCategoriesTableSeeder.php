<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('faq_categories')->insert(['name' => 'BESTELLEN EN LEVEREN', 'slug' => 'bestellen en leveren', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('faq_categories')->insert(['name' => 'BETALEN', 'slug' => 'betalen', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('faq_categories')->insert(['name' => 'RETOURNEREN', 'slug' => 'retourneren', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('faq_categories')->insert(['name' => 'GARANTIE', 'slug' => 'garantie', 'created_at' => now(), 'updated_at' => now()]);

    }
}
