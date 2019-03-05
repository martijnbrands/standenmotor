<?php

use App\Team;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'          => 'Danny Klaren',
            'email'         => 'danny@standenmotor.nl',
            'password'      => bcrypt('secret'),
            'account_type'  => 'super_admin'
        ]);

        DB::table('users')->insert([
            'name'          => 'Martijn Brands',
            'email'         => 'martijn@standenmotor.nl',
            'password'      => bcrypt('secret'),
            'account_type'  => 'super_admin'
        ]);
    }
}
