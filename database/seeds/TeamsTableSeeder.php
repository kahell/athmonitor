<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Model\Teams\Teams;
use App\Model\Teams\Coaches;

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
        $coach = Coaches::all();

        // Teams::truncate();

        foreach (range(1,3) as $i) {
          Teams::create([
            'name' => $faker->name,
            'avatar' => $faker->imageUrl(640, 480, 'nature'),
            'description' => $faker->paragraph(mt_rand(5,15)),
            'address' => $faker->address,
            'city' => $faker->city,
            'province' => $faker->state,
            'coach_id' => $coach[$i - 1]->id
          ]);
        }
    }
}
