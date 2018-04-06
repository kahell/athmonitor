<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Model\user\Roles;

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
        'name' => 'coache'
      ]);
      Roles::create([
        'name' => 'admin'
      ]);
    }
}
