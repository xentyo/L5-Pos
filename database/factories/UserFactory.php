<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function(Faker $faker){
  return [
    'name' => $faker->firstName() . ' ' . $faker->lastName,
    'email' => $faker->safeEmail,
    'password' => bcrypt('seller123')
  ];
});
