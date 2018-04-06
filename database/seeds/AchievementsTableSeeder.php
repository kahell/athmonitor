<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Model\user\Achievements;

class AchievementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Factory::create();

      // Achievements::truncate();

      foreach (range(1,5) as $i) {
        Achievements::create([
          'name' => $faker->randomElement(['NBA Championship', 'DBL Championship', 'LA Championship', 'Best Players','Rich Player']),
          'achieve_id' => $i,
          'images' => $faker->imageUrl(640, 480, 'nature'),
          'description' => $faker->sentence,
          'level' => $faker->randomElement([1, 2, 3, 4])
        ]);
      }
    }
}
