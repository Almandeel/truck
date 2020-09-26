<?php

use App\User;

use App\Market;
use App\Employee;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'phone'     => '0123456',
            'name'     => 'super',
            'code'      => '249',
            'password'  => bcrypt('123456'),
        ]);

        $superadmin->attachRole('superadmin');
    }
}
