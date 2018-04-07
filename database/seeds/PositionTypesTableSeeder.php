<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Model\user\Sports;
use App\Model\user\Position_types;

class PositionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Factory::create();
      $sport = Sports::all();

      foreach (range(1,3) as $i) {
        Position_types::create([
          'name' => $faker->name,
          'sport_id' => $sport[$i - 1]->sport_id,
        ]);
      }
    }
}
