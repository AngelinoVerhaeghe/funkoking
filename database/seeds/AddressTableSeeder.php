<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            'user_id' => '1',
            'street' => 'Reutelbeek',
            'city' => 'Hasselt',
            'number' => '666',
            'country' => 'Belgie',
            'postalcode' => '1312',
            'postbox' => 'NULL',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
