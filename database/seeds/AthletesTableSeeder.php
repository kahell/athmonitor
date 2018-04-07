<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Model\user\Athletes;
use App\Model\user\Coaches;
use App\Model\user\Teams;
use App\Model\user\Position_types;

class AthletesTableSeeder extends Seeder
{

  public function run()
  {
    $faker = Factory::create();
    $coach = Coaches::all();
    $position = Position_types::all();

    foreach (range(1,3) as $i) {
      $chooseGender = $faker->randomElement(['male', 'female']);
      $genderInitial = ($chooseGender == 'male') ? 'M' : 'F';
      $team = Teams::where('coach_id',$coach[$i - 1]->coach_id)->get();
      Athletes::create([
        'coach_id' => $coach[$i - 1]->coach_id,
        'team_id' => $team[0]->team_id,
        'position_type_id' => $position[$i -1]->position_type_id,
        'achieve_key' => $faker->unixTime($max = 'now'),
        'fullname' => $faker->name,
        'gender' => $faker->randomElement([1, 2]),
        'avatar' => 'http://www.designskilz.com/random-users/images/image'.$genderInitial.rand(1, 50).'.jpg',
        'address' => $faker->address,
        'bod' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'phone_number' => $faker->phoneNumber,
        'player_number' => $faker->numberBetween($min = 1, $max = 100),
        'player_status' => $faker->randomElement([1, 2])
      ]);
    }
  }
}
