<?php

use App\Account;
use App\Pricing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(AccountSeeder::class);
        $safeAccount = Account::firstOrCreate(['name' => 'safe']);
        $this->call(LaratrustSeeder::class);
        // $this->call(PricingSeeder::class);
        $ratio = Pricing::firstOrCreate(['name' => 'نسبة التوصيل', 'amount' => 5]);
        $this->call(SuperAdminSeeder::class);
    }
}
