<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SubCategoriesTableSeeder::class);
        $this->call(FaqCategoriesTableSeeder::class);
        $this->call(PhotosTableSeeder::class);
        $this->call(BlogCategoriesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(PaymentPlatformsTableSeeder::class);
        $this->call(AddressTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
