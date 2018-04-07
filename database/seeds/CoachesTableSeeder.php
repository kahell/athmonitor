<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Model\user\Coaches;
use App\Model\user\Sports;
use App\Model\user\User;

class CoachesTableSeeder extends Seeder
{

    public function run()
    {
      $faker = Factory::create();
      $user = User::all();
      $sport = Sports::all();

      foreach (range(1,3) as $i) {
        Coaches::create([
          'user_id' => $user[$i - 1]->user_id,
          'sport_id' => $sport[$i - 1]->sport_id,
          'achieve_key' => $faker->unixTime($max = 'now')
        ]);
      }
    }
}
