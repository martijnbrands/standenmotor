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
        DB::table('teams')->insert([
            'name' => 'Heren 2'
        ]);

        DB::table('users')->insert([
            'name' => 'Martijn',
            'email' => 'martijn@standenmotor.nl',
            'password' => bcrypt('admin123'),
            'team_id' => 1
        ]);
    }
}
