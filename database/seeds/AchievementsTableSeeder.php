<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Model\Teams\Achievements;
use App\Model\Teams\Coaches;
use App\Model\Teams\Athletes;
use App\Model\Teams\Teams;

class AchievementsTableSeeder extends Seeder
{

    public function run()
    {
      $faker = Factory::create();
      $coachKey = Coaches::all();
      $athleteKey = Athletes::all();
      $teamKey = Teams::all();

      foreach (range(1,3) as $i) {
        Achievements::create([
          'name' => $faker->randomElement(['NBA Championship', 'DBL Championship', 'LA Championship', 'Best Players','Rich Player']),
          'coach_id' => $coachKey[$i - 1]->id,
          'athlete_id' => $athleteKey[$i - 1]->id,
          'team_id' => $teamKey[$i - 1]->id,
          'images' => $faker->imageUrl(640, 480, 'nature'),
          'description' => $faker->paragraph(mt_rand(5,15)),
          'level' => $faker->randomElement([1, 2, 3, 4])
        ]);
      }
    }
}
