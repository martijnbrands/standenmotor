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
        DB::table('users')->insert([
            'name' => 'Martijn',
            'email' => 'martijn@standenmotor.nl',
            'password' => bcrypt('admin123'),
        ]);

        $this->call(PlayerSeeder::class);
    }
}