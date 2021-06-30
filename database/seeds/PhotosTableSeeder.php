<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photos')->insert(['name' => 'default-image', 'file' => 'default-image.jpg', 'created_at' => now(), 'updated_at' => now()]);
    }
}
