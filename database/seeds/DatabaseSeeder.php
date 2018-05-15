<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SportsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CoachesTableSeeder::class);
        $this->call(PositionTypesTableSeeder::class);
        // $this->call(TeamsTableSeeder::class);
        // $this->call(AthletesTableSeeder::class);
        // $this->call(AchievementsTableSeeder::class);
    }
}
