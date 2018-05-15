<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Model\Sports\Sports;
use App\Model\Sports\Position_types;

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

      $name = [
        "basketball" => [
          "Point guard","Shooting Guard","Small Forward","Power Forward","Center"
        ],
        "voleyball" => [
          "Right Back", "Right Front", "Middle Front", "Left Front", "Left Back", "Middle Back"
        ],
        "football" => [
          "Goalkeeper", "Centre-back", "Sweeper", "Full-back", "Wing-back",
          "Centre midfield","Defensive midfield","Attacking midfield","Wide midfield",
          "Centre forward", "Second striker", "Winger"
        ]
      ];
      // Basket
      foreach (range(0,4) as $i) {
        Position_types::create([
          'name' => $name["basketball"][$i],
          'sport_id' => 1,
        ]);
      }

      // Voleyball
      foreach (range(0,5) as $i) {
        Position_types::create([
          'name' => $name["voleyball"][$i],
          'sport_id' => 1,
        ]);
      }

      // Football
      foreach (range(0,11) as $i) {
        Position_types::create([
          'name' => $name["football"][$i],
          'sport_id' => 1,
        ]);
      }

    }
}
