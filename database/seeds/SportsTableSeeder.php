<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Model\Sports\Sports;

class SportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Factory::create();
      Sports::create([
        'name' => 'Basketball',
        'description' => $faker->sentence
      ]);
      Sports::create([
        'name' => 'Voleyball',
        'description' => $faker->sentence
      ]);
      Sports::create([
        'name' => 'Football',
        'description' => $faker->sentence
      ]);
    }
}
