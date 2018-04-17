<?php

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function(Faker $faker){
  return [
    'name' => $faker->firstName() . ' ' . $faker->lastName,
    'email' => $faker->safeEmail,
    'phone_number' => $faker->phoneNumber,
    'address' => $faker->address,
    'city' => $faker->city,
    'state' => $faker->state,
    'comment' => $faker->text(100),
    'company_name' => $faker->company
  ];
});
