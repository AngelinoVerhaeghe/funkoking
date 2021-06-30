<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'id' => '1',
            'photo_id' => '1',
            'name' => 'Angelino Verhaeghe',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'address_id' => '1',
            'password' => Hash::make('12345678'),
            /*'remember_token' => Str::random(10),*/
            'created_at' => now(),
            'updated_at' => now()
        ]);
        //factory('App\User', 20)->create();
    }
}
