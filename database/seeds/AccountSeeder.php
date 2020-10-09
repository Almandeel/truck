<?php

use App\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('... Creating Accounts ...');
        $safeAccount = Account::firstOrCreate(['name' => 'safe']);
        $this->command->info('Creating Safe Account...');
    }
}
