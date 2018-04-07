<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Model\user\Achievements;
use App\Model\user\Coaches;
use App\Model\user\Athletes;
use App\Model\user\Teams;

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
          'achieve_key' => $faker->randomElement([$coachKey[$i - 1]->achieve_key, $athleteKey[$i - 1]->achieve_key, $teamKey[$i - 1]->achieve_key]),
          'images' => $faker->imageUrl(640, 480, 'nature'),
          'description' => $faker->sentence,
          'level' => $faker->randomElement([1, 2, 3, 4])
        ]);
      }
    }
}
