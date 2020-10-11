<?php

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
        $this->call(AccountSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(PricingSeeder::class);
        $this->call(SuperAdminSeeder::class);
    }
}
