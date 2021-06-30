<?php

use App\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Maken array en vullen met de mogelijke Munten
        $currencies = [
            'USD', 'EUR', 'GBP'
        ];

        foreach ($currencies as $currency){
            Currency::create([
                'iso' => $currency,
            ]);
        }
    }
}
