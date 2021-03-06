<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
// use App\Model\Users\User;
use App\Model\Users\Statuses;
use TCG\Voyager\Models\User;
use TCG\Voyager\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Factory::create();
      $role = Role::where('name', 'admin')->firstOrFail();
      $genderInitial = 'M';

      User::create([
        'fullname' => "admin",
        'gender' => $faker->randomElement([1, 2]),
        'avatar' => 'http://www.designskilz.com/random-users/images/image'.$genderInitial.rand(1, 50).'.jpg',
        'address' => $faker->address,
        'bod' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'phone_number' => $faker->phoneNumber,
        'username' => "admin",
        'email' => "admin@admin.com",
        'password' => bcrypt('password'),
        'remember_token' => str_random(60),
        'role_id'  => $role->id
      ]);

      Statuses::create([
        'user_id' => 1,
        'account_status_id' => $faker->randomElement([1,2,3,4]),
        'blocked_time' => $faker->dateTime(),
        'last_login' =>$faker->dateTime(),
        'isBlocked' => 0,
        'accVerificationCode' => '',
        'isResetPass' => 0,
        'resetPassVerificationCode' => ''
      ]);

      // foreach (range(1,3) as $i) {
      //   $chooseGender = $faker->randomElement(['male', 'female']);
      //   $genderInitial = ($chooseGender == 'male') ? 'M' : 'F';
      //
      //   User::create([
      //     'fullname' => $faker->name,
      //     'gender' => $faker->randomElement([1, 2]),
      //     'avatar' => 'http://www.designskilz.com/random-users/images/image'.$genderInitial.rand(1, 50).'.jpg',
      //     'address' => $faker->address,
      //     'bod' => $faker->date($format = 'Y-m-d', $max = 'now'),
      //     'phone_number' => $faker->phoneNumber,
      //     'username' => $faker->unique()->userName,
      //     'email' => $faker->unique()->safeEmail,
      //     'password' => bcrypt('password'),
      //     'remember_token' => str_random(60),
      //     'role_id'  => $role->id
      //   ]);
      // }

      // $user = User::all();
      // foreach (range(1,3) as $i) {
      //   Statuses::create([
      //     'user_id' => $user[$i - 1]->id,
      //     'account_status_id' => $faker->randomElement([1,2,3,4]),
      //     'blocked_time' => $faker->dateTime(),
      //     'last_login' =>$faker->dateTime(),
      //     'isBlocked' => 0,
      //     'accVerificationCode' => '',
      //     'isResetPass' => 0,
      //     'resetPassVerificationCode' => ''
      //   ]);
      // }

    }
}
