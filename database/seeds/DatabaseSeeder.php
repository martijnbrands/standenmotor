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
        // $this->call(UsersTableSeeder::class);

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

        DB::table('users')->insert([
            'name'          => 'Martijn Brands',
            'email'         => 'martijnbrands@standenmotor.nl',
            'password'      => bcrypt('secret'),
            'account_type'  => 'team_admin'
        ]);

        DB::table('users')->insert([
            'name'          => 'Heren 2',
            'email'         => 'heren2@standenmotor.nl',
            'password'      => bcrypt('secret'),
            'account_type'  => 'team'
        ]);

        $team = factory('App\Team')->create([
            'name' => 'Heren 2',
            'user_id' => 3
        ]);

        DB::table('players')->insert([
            'name'          => 'Martijn Brands',
            'goals'         => 5,
            'assists'       => 2,
            'points'        => 20,
            'team_id'       => $team->id
        ]);

        DB::table('players')->insert([
            'name'          => 'Sander Brands',
            'goals'         => 2,
            'assists'       => 5,
            'points'        => 10,
            'team_id'       => $team->id
        ]);
    }
}
