<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['name' => 'Administrator', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('roles')->insert(['name' => 'Buyer', 'created_at' => now(), 'updated_at' => now()]);

        DB::table('user_role')->insert(['user_id' => '1', 'role_id' => '1', 'created_at' => now(), 'updated_at' => now()]);
    }
}
