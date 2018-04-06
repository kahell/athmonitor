<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Model\user\Coaches;

class CoachesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Factory::create();

      foreach (range(1,3) as $i) {
        Coaches::create([
          'user_id' => $i,
          'sport_id' => $i,
          'achieve_id' => $i
        ]);
      }
    }
}
