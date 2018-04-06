<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Model\user\Teams;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        // Teams::truncate();

        foreach (range(1,3) as $i) {
          Teams::create([
            'name' => $faker->name,
            'avatar' => $faker->imageUrl(640, 480, 'nature'),
            'description' => $faker->sentence,
            'address' => $faker->address,
            'city' => $faker->city,
            'province' => $faker->state,
            'achieve_id' => $i,
            'coach_id' => $i
          ]);
        }
    }
}
