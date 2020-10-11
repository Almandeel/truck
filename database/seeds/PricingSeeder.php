<?php

use App\Pricing;
use Illuminate\Database\Seeder;

class PricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratio = Pricing::firstOrCreate(['name' => 'نسبة التوصيل', 'amount' => 5]);
    }
}
