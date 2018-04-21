<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Model\Sports\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Factory::create();
      Roles::create([
        'name' => 'admin'
      ]);
      Roles::create([
        'name' => 'coach'
      ]);

    }
}
