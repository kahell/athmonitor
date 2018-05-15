<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Model\Users\User;
use App\Model\Sports\Sports;
use App\Model\Teams\Coaches;

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
      $user = User::all();
      $sport = Sports::all();

      Coaches::create([
        'user_id' => 1,
        'sport_id' => 1
      ]);

      // foreach (range(1,3) as $i) {
      //   Coaches::create([
      //     'user_id' => $user[$i - 1]->id,
      //     'sport_id' => $sport[$i - 1]->id
      //   ]);
      // }
    }
}
